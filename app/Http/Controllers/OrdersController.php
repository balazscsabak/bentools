<?php

namespace App\Http\Controllers;

use App\Events\CancelledOrderByCustomerEvent;
use App\Mail\OrderInTransportEmail;
use App\Models\Errors;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function orders(Request $request)
    {
        $orders = Orders::where('status', '!=', 'ERROR')->get();
        
        return view('admin.orders.orders')
            ->with('orders', $orders);
    }

    public function order(Request $request, $id) 
    {
        $order = Orders::where('unique_id', '=', $id)->first();

        if(!$order) {
            return redirect()->route('admin.orders');
        }

        return view('admin.orders.order')
            ->with('order', $order);
    }   

    public function updateStatus(Request $request, $id) 
    {
        if(!isset($id) || $id < 1 ) {
            abort(404);
        }

        $order = Orders::find($id);

        if(!$order){
            abort(404);
        }

        $newStatus = $request->order_status;
        $oldStatus = $order->status;

        if($oldStatus === $newStatus) {
            return redirect()->back()->with('success', 'Sikeres módosítás');
        }

        $order->status = $newStatus;
        $order->save();
        
        if($newStatus === 'IN_TRANSPORT') {
            $userId = $order->user_id;
            $user = User::find($userId);

            Mail::to($user->email)->send(new OrderInTransportEmail($user, $order));
        }
        
        return redirect()->back()->with('success', 'Sikeres módosítás');
    }

    public function cancelOrder(Request $request) 
    {
        $id = $request->id;
        
        if(!isset($id) || $id < 1 ) {
            abort(404);
        }

        $order = Orders::find($id);

        if(!$order){
            abort(404);
        }

        $user = Auth::user();

        if($order->user_id !== $user->id) {
            abort(404);
        }

        $order->status = 'CANCELLED';
        $order->save();

        CancelledOrderByCustomerEvent::dispatch($order);
        
        return redirect()->back()->with('success', 'Rendelés visszavonva!');
    }
}
