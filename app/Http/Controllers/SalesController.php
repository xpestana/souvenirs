<?php

namespace App\Http\Controllers;

use App\Mail\SaleSouvenirReceived;
use App\Mail\AdminReceived;
use App\Mail\SaleActivityReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\Products;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\User;
use App\Models\hotel;
use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\RedsysAPI;
use Redirect;
use Cart;

class SalesController extends Controller
{
    public function __construct() {
        /*STRIPE*/
         Stripe::setApiKey(env('STRIPE_KEY'));
    }

    public function checkout(Request $request)
    {
        $hotel = null;


        /****************************/
        if (auth()->user()) {
            if (!auth()->user()->hotel->isEmpty()) {
                $hotel = hotel::find(auth()->user()->hotel->first()->id);
            }
        }
        $act = false;
        $products = Cart::getContent(); 
        $forms_extra = array();
        foreach($products as $product){
            if ($product->attributes["type"] =="activity") {
                $forms = Http::post('https://app.turitop.com/v1/product/getclientform', [
                        'access_token'   => connect()['access_token'],
                        'data' => [
                                    "product_short_id"=>$product->attributes["short_id"],
                                    'language_code'=>"en"
                                ]
                    ])->collect()['data']['client_form'];

                foreach ($forms as $form) {
                if ($form['key'] != "name" && $form['key'] != "country" && $form['key'] != "phone") {
                    if ($form['required'] == true) {
                        array_push($forms_extra,$form);
                    }
                }
                }
            }
        }
        return Inertia::render('Checkout', compact('hotel', 'forms_extra'));
    }
    public function sale(Request $request)
    {
        
               return redirect()->route('redsys',$request->all());
    }
    public function sale_redsys(Request $request)
    {
       if (auth()->user()) {
            $id = auth()->user()->id;
            $user = User::find($id-1);
            $hotel_id = (!auth()->user()->hotel->isEmpty()) ? auth()->user()->hotel->first()->id : null;
        }else{
            $user = User::where('email','clientAdmin@email.com')->first();
            $hotel_id= null;
        }

        $order = 1;

        while (!is_null($order)) {
            $order_id = orderId();
            $order = Order::where("transaction_id", )->first();

        }
        
        $miObj = new RedsysAPI();

        // Valores de entrada que no hemos cmbiado para ningun ejemplo
        $fuc="097282966";
        $terminal="001";
        $moneda="978";
        $trans="0";
        $url="";
        $urlOK=route('purchase',["oi" => $order_id]);
        $urlKO=route('purchase',["oi" => $order_id, "deny"=> 1]);
        $id=time();
        $amount=$request->total*100;  
        $name = $request->name_env;
        $email = $request->email_env;
        $address = $request->address_env;
        $cp = $request->cp_env;
        $phone = $request->phone_env;
        $hab = $request->hab_env;
        $observations = $request->observations_env;

        // Se Rellenan los campos
        $miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
        $miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
        $miObj->setParameter("DS_MERCHANT_ORDER",$id);
        $miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);  
        $miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
        $miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
        $miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
        $miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);
        $miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);
        //Datos de configuración
        $version="HMAC_SHA256_V1";
        $kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
        // Se generan los parámetros de la petición
        $request = "";
        $params = $miObj->createMerchantParameters();
        $signature = $miObj->createMerchantSignature($kc);

       /*Creando Orden de compra*/

       $order = Order::create([ 
                'user_id' => $user->id,
                'transaction_id' => $order_id,
                'total' => $amount/100,
                'hotel_id' => $hotel_id,
                'Ds_SignatureVersion' => $version,
                'Ds_MerchantParameters' => $params,
                'Ds_Signature' => $signature,
                'status' => "pending",
            ]);

       $products = Cart::getContent();
            foreach($products as $product){
                  $shipping = Shipping::create([ 
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $product->quantity,
                    'firstname' => $name,
                    'email' => $email,
                    'address' => $address,
                    'zip_code' => $cp,
                    'phone' => $phone,
                    'hab' => $hab,
                    'observations' => $observations,
                    'amount' => $product->price,
                    ]);
                
                }
        //Cart::clear();
        return view('Purchase', compact('version', 'params', 'signature'));
       /* 
            Mail::to($request->email)->send(new SaleSouvenirReceived($order));
            Mail::to("info@hicitty.es")->send(new AdminReceived($order));
        return Redirect::route('purchase',['oi' => $order->id]);
        */
        
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
            'hab' => 'required',
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
                    'hab' => $request->hab,
                ]);

            foreach ([$request->email, 'xpestana4@gmail.com'] as $recipient) {
                Mail::to($recipient)->send(new SaleActivityReceived($order));
            }

            return Redirect::route('purchase',['oi' => $order->id]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function purchase(Request $request)
    {
        $order = Order::where("transaction_id", $request->oi)->first()->load('shippings.product.images');
        $deny = ($request->deny) ? $request->deny : null; 
        $order->status = ($request->deny) ? "cancelled" : "complete";
        $order->save();
            
        $id = mt_Rand(1000000, 9999999);

        $message = "Registro de pago exitoso";
        $code = 200;
        $status = "success";

        if ($request->deny) {
            $message = "Registro de pago cancelado";
            $code = 400;
            $status = "error";
        }
        return Inertia::render('Sales/Purchase', compact('order'))->with(['id'=>$id, 'message' => $message, 'code' => $code, 'status' => $status]);
    }
    public function sale_admin()
    {
        $orders = Order::all()->load('shippings.product.images', 'user.hotel');
        $total = $orders->sum('total');
        return Inertia::render('Dashboard/Shoppings', compact('orders', 'total'));
    }
    public function sale_hotel()
    {
        $hotel = hotel::find(auth()->user()->hotel->first()->id);
        $orders = $hotel->user()->wherePivot('manager', false)->first()->orders->load('shippings.product.images');
        $total = $orders->sum('total');
        return Inertia::render('Dashboard/Shoppings', compact('orders', 'total'));
    }
    public function purchase_show($order){
        $order = Order::find($order)->load('shippings.product.images');
        return Inertia::render('Dashboard/Show/Shoppings', compact('order'));
    }
}
