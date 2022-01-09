<?php

namespace App\Http\Controllers;

use App\Events\NewOrderEvent;
use App\Models\Errors;
use App\Models\OrderInfo;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Purchases;
use App\Models\Variants;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function showOrder(Request $request, $hash)
    {
        $user = Auth::user();
        $order = Orders::where('hash', $hash)->first();

        if (!$order ||
            $order->user_id !== $user->id ||
            $order->hash !== $hash) {
            abort(404);
        }

        return view('purchase-order')
            ->with('order', $order)
            ->with('user', $user);
    }

    public function checkout(Request $request)
    {
        /**
         * TODO - return error masssage login error
         */
        if (!Auth::check()) {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                // Authentication passed...
                // return redirect()->intended('dashboard');
                return back()->with('error', 'Auth error');
            }

        }

        $user = Auth::user();

        $cart = session('cart');
        $summ = 0;
        $summNet = 0;

        foreach ($cart['items'] as $item) {
            $sumPerItem = $item->price * $item->quantity;
            $sumPerItemNet = $item->net_price * $item->quantity;

            $summNet += $sumPerItemNet;
            $summ += $sumPerItem;
        }

        return view('checkout')
            ->with('user', $user)
            ->with('summ', $summ)
            ->with('summNet', $summNet)
            ->with('cart', $cart);
    }

    public function purchase(Request $request)
    {
        $method = $request->method;

        $shippingPostcode = $request->shippingPostcode;
        $shippingCity = $request->shippingCity;
        $shippingStreet = $request->shippingStreet;
        $shippingCounty = $request->shippingCounty;
        $billingPostcode = $request->billingPostcode;
        $billingCity = $request->billingCity;
        $billingStreet = $request->billingStreet;
        $billingCounty = $request->billingCounty;

        $firmName = $request->firmName;
        $taxNumber = $request->taxNumber;
        $phonenumber = $request->phonenumber;

        $addressInfo = (object) [
            'shippingPostcode' => $shippingPostcode,
            'shippingCity' => $shippingCity,
            'shippingStreet' => $shippingStreet,
            'shippingCounty' => $shippingCounty,
            'billingPostcode' => $billingPostcode,
            'billingCity' => $billingCity,
            'billingStreet' => $billingStreet,
            'billingCounty' => $billingCounty,
        ];

        $confirmCartSumm = intval($request->confirmCartSumm);

        $user = Auth::user();
        $cart = session('cart');
        $summ = 0;
        $summNet = 0;

        foreach ($cart['items'] as $item) {
            $sumPerItem = $item->price * $item->quantity;
            $sumPerItemNet = $item->net_price * $item->quantity;

            $summ += $sumPerItem;
            $summNet += $sumPerItemNet;
        }

        if ($confirmCartSumm !== $summ) {
            abort(404);
        }

        if ($summNet < 6000) {
            // abort(404);
        }

        // create order
        $order = $this->createOrder($method, $summ, $summNet, 'HUF');

        if ($method === '3') {
            /**
             * CARD
             */
            $paymentMethodId = $request->paymentMethodId;
            $cardHolderName = $request->cardHolderName;

            try {
                $stripeCustomer = $user->createOrGetStripeCustomer();

            } catch (Exception $e) {
                $order->status = "PURCHASE_ERROR";
                $order->save();
                Errors::storeNewException('Error on create or get customer', $e->getMessage(), 'purchase', 'purchase', $user->id);
                abort(404);
            }

            try {

                $stripeCharge = $request->user()->charge(
                    intval($summ * 100),
                    $request->paymentMethodId,
                    [
                        'customer' => $stripeCustomer->id,
                        'currency' => 'huf',
                        'receipt_email' => $user->email,
                    ]
                );

                $purchase = new Purchases();

                $purchase->order_id = $order->id;
                $purchase->stripe_id = $stripeCharge->id;
                $purchase->stripe_amount = $stripeCharge->amount;
                $purchase->real_amount = $summ;
                $purchase->status = $stripeCharge->status;
                $purchase->payment_method_id = $paymentMethodId;
                $purchase->card_holder_name = $cardHolderName;
                $purchase->customer = $stripeCharge->customer;
                $purchase->receipt_email = $stripeCharge->receipt_email;
                $purchase->stripe_created = $stripeCharge->created;
                $purchase->paid = true;
                $purchase->refunded = false;
                $purchase->stripe_response = json_encode($stripeCharge);

                $purchase->save();

            } catch (Exception $e) {
                $order->status = "ERROR";
                $hashString = $order->id . $user->id . strtotime('now');
                $order->hash = hash('md5', $hashString);

                $order->save();

                Errors::storeNewException('Error on Stripe charge', $e->getMessage(), 'purchase', 'purchase', $user->id, 'order_id', $order->id);

                return response()->json([
                    'status' => false,
                    'err_code' => 'purchase_failed',
                    'hash' => $order->hash,
                ]);
            }

        } else if ($method === '2') {
            /**
             * TRANSFER
             */
        } else if ($method === '1') {
            /**
             * CASH ON DELIVERY
             */
        }

        // save order items
        $this->saveOrderItems($order->id);

        // save order data
        $this->orderInfo($order->id, $addressInfo, $firmName, $taxNumber, $phonenumber);

        $hashString = $order->id . $user->id . strtotime('now');

        if ($method === '3') {
            /**
             * CARD
             */
            $order->status = 'SUCCESS';

        } else if ($method === '2') {
            /**
             * 30 DAYS TRANSFER
             */
            $order->status = 'PENDING';

        } else if ($method === '1') {
            /**
             * TRANSFER
             */
            $order->status = 'PENDING';

        }

        $order->hash = hash('md5', $hashString);

        $order->save();

        // UserRegistration::dispatch($user);
        NewOrderEvent::dispatch($user, $order);

        return response()->json([
            'status' => true,
            'hash' => $order->hash,
        ]);
    }

    public function createOrder($method, $price, $summNet, $currency = 'HUF')
    {
        $user = Auth::user();
        $order = new Orders();
        $order->user_id = $user->id;
        $order->method = $method;
        $order->status = 'PENDING';
        $order->price = $price;
        $order->net_price = $summNet;
        $order->currency = $currency;

        $order->save();

        $order->unique_id = 'or' . $order->id . 'u' . $user->id;
        $order->save();

        return $order;
    }

    public function saveOrderItems($orderId)
    {
        $user = Auth::user();
        $cart = session('cart');
        $order = Orders::find($orderId);

        foreach ($cart['items'] as $item) {

            try {

                $variant = Variants::find($item->variant_id);
                $orderItem = new OrderItems();
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->quantity = $item->quantity;
                $orderItem->price_sum = $item->quantity * $item->price;
                $orderItem->price_per_item = $item->price;
                $orderItem->variant_id = $item->variant_id;
                $orderItem->product_id = $item->product_id;
                $orderItem->sku = $item->sku;
                $orderItem->attr = $variant->attr;
                $orderItem->attr_values = $variant->attr_values;

                $orderItem->save();

            } catch (Exception $e) {
                Errors::storeNewException('Error on saving order item', $e->getMessage(), 'purchase', 'saveOrderItems', $user->id, 'order_id', $orderId);
                abort(404);
            }

        }
    }

    public function orderInfo($orderId, $addressInfo, $firmName, $taxNumber, $phonenumber)
    {
        $orderInfo = new OrderInfo();

        $orderInfo->order_id = $orderId;
        $orderInfo->shipping_postcode = $addressInfo->shippingPostcode;
        $orderInfo->shipping_city = $addressInfo->shippingCity;
        $orderInfo->shipping_street = $addressInfo->shippingStreet;
        $orderInfo->shipping_county = $addressInfo->shippingCounty;
        $orderInfo->billing_postcode = $addressInfo->billingPostcode;
        $orderInfo->billing_city = $addressInfo->billingCity;
        $orderInfo->billing_street = $addressInfo->billingStreet;
        $orderInfo->billing_county = $addressInfo->billingCounty;
        $orderInfo->billing_county = $addressInfo->billingCounty;

        $orderInfo->firm_name = $firmName;
        $orderInfo->tax_number = $taxNumber;
        $orderInfo->phone_number = $phonenumber;

        $orderInfo->save();
    }

    public function showOrderError(Request $request, $hash)
    {
        $order = Orders::where('hash', $hash)->first();

        if (!$order) {
            abort(404);
        }

        return view('purchase-error')->with('order', $order);
    }

}
