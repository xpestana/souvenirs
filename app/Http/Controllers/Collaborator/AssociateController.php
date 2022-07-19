<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\hotel;
use App\Models\User;
use App\Models\Order;
use App\Models\profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\DisplayReceiver;
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
        $cont = step();
        $orders = Order::where('user_id',auth()->user()->id)
                    ->where("status","complete")
                    ->where("returned",0)
                    ->with('shippings')->get();
        $associate = auth()->user()->associate; 
        return Inertia::render('Associates/Dashboard/Home', compact('cont','url','orders','associate'));
    }
    public function sales(Request $request){
        $orders = Order::where('user_id',auth()->user()->id)
                    ->where("status","complete")
                    ->where("returned",0)
                    ->with('shippings')
                    ->Date($request->desde, $request->hasta)->paginate(15);
        $totalOrders = Order::where('user_id',auth()->user()->id)
                ->where("status","complete")
                ->where("returned",0)
                ->with('shippings')
                ->Date($request->desde, $request->hasta)->get();
        $withdrawal = $orders->where("withdrawal",0);

        
        $date = null;

        if (!$withdrawal->isEmpty()) {
            $date = $withdrawal->first()->updated_at;
        }
        return Inertia::render('Associates/Dashboard/Collaboration/Sales', compact('orders','totalOrders'));
    }

    public function resource_index (Request $request) {
        return Inertia::render('Associates/Dashboard/Resource/Welcome');
    }

    public function resource_display (Request $request) {
        return Inertia::render('Associates/Dashboard/Resource/Display');
    }

    public function resource_banner (Request $request) {
        $city = $request->city ?? null;
        $width = $request->width ?? null;
        $url = [
            'path' => null,
            'fullPath' => null,
        ];
        $href = null;
        if ($city && $width) {
            $idUser = auth::user()->id;
            $href = url('?p='.$city.'&c='.$idUser.'&t=2');
            if ($city == 'sevilla' && $width == '160x600') {
                $url['path'] = 'vendor_asset/img/collaborator/dashboard/banners/160x600.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
            if ($city == 'sevilla' && $width == '200x700') {
                $url['path'] = 'vendor_asset/img/collaborator/dashboard/banners/200x700.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
            if ($city == 'sevilla' && $width == '728x90') {
                $url['path'] =  'vendor_asset/img/collaborator/dashboard/banners/728x90.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
        }
        return Inertia::render('Associates/Dashboard/Resource/Banner', compact('url', 'href'));
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
    public function resource_url (Request $request) {
        $city = $request->city ?? null;
        $url = null;
        if ($city) {
            $idUser = auth::user()->id;
            $url = url('?p='.$city.'&c='.$idUser.'&t=2');
        }
        return Inertia::render('Associates/Dashboard/Resource/Url', compact('url'));
    }

    public function send_resource_display (Request $request) {
        $request->validate([
            'city' => 'required|string',
            'displays' => 'required|array'
        ]);
        $user = auth()->user();
        $user->resources()->createMany([
            ['name' => 'request-display', ],
            ['name' => 'received-display'],

        ]);
        $data = [
            'user' => $user,
            'city' => $request->city ?? null,
            'displays' => $request->displays ?? null,
        ];
        Mail::to("info@hicitty.es")->send(new DisplayReceiver($data));
        return back();
    }

    public function services () {
        return Inertia::render('Associates/Dashboard/Services');
    }

}
