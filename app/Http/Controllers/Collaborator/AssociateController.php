<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\hotel;
use App\Models\User;
use App\Models\Order;
use App\Models\profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use App\Mail\WelcomeReceived;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Auth\Events\Registered;
use Redirect;
use Image;

class AssociateController extends Controller
{
    public function collaboration(){
        $ordersTotal = Order::where("user_id", auth()->user()->id)->orderBy('created_at','DESC')->get();
        $orders = Order::where("user_id", auth()->user()->id)
                    ->where("status","complete")
                    ->orderBy('created_at','DESC')
                    ->paginate(10);
        $orders->load('shippings');
        $url = config('app.url');
        $hotels = auth()->user()->hotel->load('orders.shippings');       
        return Inertia::render('Associates/Dashboard/Collaboration', compact('hotels','orders','url','ordersTotal'));
    }

    public function associate_home(Request $request)
    {
        $url = config('app.url');
        $cont = 4;
        $hotels = auth()->user()->hotel->load('orders.shippings');
        $orders = Order::whereIn('hotel_id',$hotels->pluck('id'))->where("status","complete")
                    ->with('hotel','shippings')->get();
        return Inertia::render('Associates/Dashboard/Home', compact('cont','hotels','url','orders'));
    }
    public function sales(Request $request){
        $hotels = auth()->user()->hotel->load('orders.shippings');
        $orders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)->paginate(15);
        $totalOrders = Order::where('user_id',auth()->user()->id)
                ->where("status","complete")
                ->with('hotel','shippings')
                ->Date($request->desde, $request->hasta)->get();
        $withdrawal = $orders->where("withdrawal",0);

        $orderLast = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)
                    ->where("withdrawal",1)->orderBy('id', 'desc')->first();
        $dateLast = $orderLast ? $orderLast->updated_at : null;

        $date = null;

        if (!$withdrawal->isEmpty()) {
            $date = $withdrawal->first()->updated_at;
        }
        return Inertia::render('Associates/Dashboard/Collaboration/Sales', compact('hotels','orders','totalOrders'));
    }

    public function withdrawal(Request $request){ 
        $orders = Order::where('user_id',auth()->user()->id)
                    ->where("status","complete")
                    ->where("returned",0)
                    ->where('withdrawal',1)
                    ->with('shippings')
                    ->Date($request->desde, $request->hasta)->paginate(15);
        $totalOrders = Order::where('user_id',auth()->user()->id)
                    ->where("status","complete")
                    ->where("returned",0)
                    ->with('shippings')->get();
        $nowithdrawal = Order::where('user_id',auth()->user()->id)
                    ->where("status","complete")
                    ->where("returned",0)
                    ->where("withdrawal",0)
                    ->orderBy('updated_at','ASC')->first();
        $withdrawal = $totalOrders->where("withdrawal",1);

        $date = null;
        
        if (!$withdrawal->isEmpty()){
            $date = $withdrawal->last()->updated_at;
        }
        if ($nowithdrawal !== null && $date == null){
            $date = $nowithdrawal->updated_at;
        }
        return Inertia::render('Associates/Dashboard/Withdrawal', compact('orders','date','totalOrders'));
    }

    public function notify_associate(Request $request){
            $orders = Order::where('user_id',auth()->user()->id)
                ->where("status","complete")
                ->where("returned",0)
                ->where("withdrawal",0)
                ->get();
            
            foreach ($orders as $order) {
                $updt = Order::find($order->id);
                $updt->withdrawal = 1;
                $updt->save();
            }

        // return back();
        
    }
}
