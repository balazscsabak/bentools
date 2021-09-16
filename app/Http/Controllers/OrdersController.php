<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

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
}
