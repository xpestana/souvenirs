<?php

namespace App\Http\Controllers\Ryders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;
use Redirect;

class ShippingController extends Controller
{
    public function pending()
    {   
        $orders = Order::where("ryder_id", null)->where('send', 0)->with('shippings.product.images')->paginate(10);
        return Inertia::render('Dashboard/Shipping', compact('orders'));
    }

    public function take($order)
    {
        $order = Order::find($order);
        $order->ryder_id = auth()->user()->profile->ryder->id;
        $order->save();
        
        return Redirect::route('shipping.my')->with(['id'=>$order->id, 'message' => 'Actualizado exitosamente', 'code' => 200, 'status' => 'success']);  
    }

    public function my()
    {   
        $orders = Order::where("ryder_id", auth()->user()->profile->ryder->id)->where('send', 0)->with('shippings.product.images')->paginate(10);
        return Inertia::render('Dashboard/MyShipping', compact('orders'));
    }

    public function finish($order)
    {
        $order = Order::find($order);
        $order->send = '1';
        $order->save();
        
        return back()->with(['id'=>$order->id+3, 'message' => 'Actualizado exitosamente', 'code' => 200, 'status' => 'success']);  
    }
}
