<?php

namespace App\Http\Controllers;

use App\Models\Variants;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function session(Request $request)
    {
        // $request->session()->forget('cart');
        
        if (!$request->session()->exists('cart')) {
            session(['cart.items' => []]);
        } 
     
        return response()->json([
            'status' => true,
            'cart' => session('cart')
        ]);
    }


    public function checkout(Request $request)
    {
        $cart = session('cart');

        return view('checkout')
            ->with('cart', $cart);
    }
    
    public function cart(Request $request)
    {
        $cart = session('cart');
        $summ = 0;
        
        foreach ($cart['items'] as $item) {
            $sumPerItem = $item->price * $item->quantity;
            $summ += $sumPerItem;
        }
        
        return view('cart')
            ->with('summ', $summ)
            ->with('cart', $cart);
    }

    public function addItem(Request $request)
    {
        /**
         * TODO, valid req
         */
        $quantity = $request->quantity;
        $id = $request->id;

        $item = Variants::find($id);

        if(!$item) {
            return response()->json([
                'status' => false,
                'msg' => 'No item found'
            ]);
        }

        $this->addItemToSession($item->product_id, $item->id, $item->sku, $item->price, $item->product->name . ' - ' . $item->sku , intval($quantity), $item->image_href);
        
        return response()->json([
            'status' => true,
            'cart' => session('cart')
        ]);
    }

    public function removeItem(Request $request)
    {
        /**
         * TODO, valid req
         */
        $id = $request->id;
        
        $this->removeItemFromSession(intval($id));

        return response()->json([
            'status' => true,
            'cart' => session('cart')
        ]);
    }

    public function decrementItem(Request $request)
    {
        /**
         * TODO, valid req
         */
        $this->decrementItemQuantityInSession(122, 4);

        return response()->json([
            'status' => true,
            'cart' => session('cart')
        ]);
    }

    private function addItemToSession($productId, $variantId, $sku, $price, $name, $quantity, $imageHref)
    {
        $cart = session('cart');
        $cartItems = $cart['items'];

        if(isset($cartItems[$variantId])) {
            $existingItem = $cartItems[$variantId];
            $existingItem->quantity += $quantity;
        } else {
            $newItem = new \stdClass();

            $newItem->product_id = $productId;
            $newItem->variant_id = $variantId;
            $newItem->sku = $sku;
            $newItem->price = $price;
            $newItem->name = $name;
            $newItem->quantity = $quantity;
            $newItem->image_href = $imageHref;

            $cartItems[$variantId] = $newItem;
        }

        session(['cart.items' => $cartItems]);
    }

    private function removeItemFromSession($variantId)
    {
        $cart = session('cart');
        $cartItems = $cart['items'];

        if(isset($cartItems[$variantId])) {
            unset($cartItems[$variantId]);
        }

        session(['cart.items' => $cartItems]);
    }

    private function decrementItemQuantityInSession($variantId, $quantity)
    {
        $cart = session('cart');
        $cartItems = $cart['items'];

        if(isset($cartItems[$variantId])) {
            $decrementItem = $cartItems[$variantId];
            $oldQuantity = $decrementItem->quantity;

            if($oldQuantity - $quantity <= 0) {
                unset($cartItems[$variantId]);
            } else {
                $decrementItem->quantity = $oldQuantity - $quantity;
            }
        }

        session(['cart.items' => $cartItems]);
    }
}

