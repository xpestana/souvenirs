<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\User;
use Stripe\Stripe;
use Inertia\Inertia;
use Redirect;
use Cart;

class SalesController extends Controller
{
    public function __construct() {
        /*STRIPE*/
         Stripe::setApiKey(env('STRIPE_KEY'));
    }

    public function checkout_souvenirs(Request $request)
    {
        $countries = config('countries');
        return Inertia::render('Checkout_souvenirs', compact('countries'));
    }
    
    public function sale_souvenirs(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        if (auth()->user()) {
            $user = auth()->user();
        }else{
            $user = User::where('email','clientAdmin@email.com')->first();
        }
        try {
            $payment = $user->charge(
                $request->amount,
                $request->payment_method_id,
                ['currency' => 'eur']
            );
            
            $payment = $payment->asStripePaymentIntent();

            $order = Order::create([ 
                'user_id' => $user->id,
                'transaction_id' => $payment->charges->data[0]->id,
                'total' => $payment->charges->data[0]->amount
            ]);
            $products = Cart::getContent();
            foreach($products as $product){
                $shipping = Shipping::create([ 
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $product->quantity,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'company' => $request->company,
                    'email' => $request->email,
                    'address' => $request->address,
                    'apart' => $request->apart,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'phone' => $request->phone,
                    'amount' => $product->price,
                ]);
            }
            Cart::clear();
            
            return Redirect::route('purchase',['oi' => $order->id]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
     public function sale_activities(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);
        
        if (auth()->user()) {
            $user = auth()->user();
        }else{
            $user = User::where('email','clientAdmin@email.com')->first();
        }
        try {
            $payment = $user->charge(
                $request->amount,
                $request->payment_method_id,
                ['currency' => 'eur']
            );
            
            $payment = $payment->asStripePaymentIntent();

            $order = Order::create([ 
                'user_id' => $user->id,
                'transaction_id' => $payment->charges->data[0]->id,
                'total' => $payment->charges->data[0]->amount
            ]);

            $shipping = Shipping::create([ 
                    'order_id' => $order->id,
                    'product_id' => $request->product_id,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'company' => $request->company,
                    'email' => $request->email,
                    'address' => $request->address,
                    'apart' => $request->apart,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'phone' => $request->phone,
                    'date_init' => $request->date_init,
                    'date_end' => $request->date_end,
                    'days' => $request->days,
                    'adult' => $request->adult,
                    'children' => $request->children,
                ]);

            return Redirect::route('purchase',['oi' => $order->id]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function purchase(Request $request)
    {
        $order = Order::find($request->oi)->load('shippings.product.images');
        $id = mt_Rand(1000000, 9999999);
        return Inertia::render('Sales/Purchase', compact('order'))->with(['id'=>$id, 'message' => 'Registro de pago exitoso', 'code' => 200, 'status' => 'success']);
    }
}
