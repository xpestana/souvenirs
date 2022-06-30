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
    public function collaborations(){
        $ordersTotal = Order::where("user_id", auth()->user()->id)->orderBy('created_at','DESC')->get();
        $orders = Order::where("user_id", auth()->user()->id)->orderBy('created_at','DESC')->paginate(10);
        $orders->load('shippings');
        $url = config('app.url');
        $hotels = auth()->user()->hotel->load('orders.shippings');       
        return Inertia::render('Associates/Dashboard/Collaboration', compact('hotels','orders','url','ordersTotal'));
    }

}
