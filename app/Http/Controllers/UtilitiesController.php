<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Mail\ContactReceived;
use App\Models\hotel;
use App\Models\User;
use App\Models\Products;
use Inertia\Inertia;
use Redirect;
use Image;

class UtilitiesController extends Controller
{
    /*STATICS PAGES*/
    public function handle_auth($id)
    {
        if($id){
        $users = Hotel::find($id)->user;
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user->getRoleNames()->first() == "Client") {
                    $auth = Auth::login($user, true);
                }
            }
        }
    }
        return 0;        
    }
    public function handle_auth_c($id)
    {
        if($id){
            $user = User::find($id+1);
            if (!empty($user)) {
                $auth = Auth::login($user, true);
            }
        }
    }
    public function session_type($t)
    {
        if ($t){
            $session = session('t');
            if (empty($session)) {
                session(['t'=>'2']);
            }
        }
    }
    public function home(Request $request)
    {   
        $this->handle_auth($request->h);
        $this->handle_auth_c($request->c);
        $this->session_type($request->t);
        return Inertia::render('Statics/Home');
    }
    public function activities(Request $request)
    {
        $this->handle_auth($request->h);
        $this->handle_auth_c($request->c);
        $search = null;
        $search = $request->search;
        $min_r = (isset($request->price[0])) ? $request->price[0] : 0;
        $max_r = (isset($request->price[1])) ? $request->price[1] : 100;


//        dd($max);
        $products = Products::with('images', 'activities')
                            ->where('del',false)
                            ->where('type', 'Activities')
                            ->search(trim($request->search))
                            ->priceA($min_r,$max_r);
        if ($request->show) {
            $products = $products->get();
            $showr = 1;
        }else{
            $products = $products->paginate(8);
            $showr = 0;
        }

        $products_responsives = Products::with('images', 'activities')
                                ->where('del',false)
                                ->where('type', 'Activities')->get();

        $count = $products_responsives->count();

        $max = $products_responsives->max('activities.priceA');
       
        return Inertia::render('Shop/Tours', compact('products', 'max', 'search', 'min_r', 'max_r', 'count','showr'));
    }


    public function souvenirs(Request $request)
    {
        $this->handle_auth($request->h);
        $this->handle_auth_c($request->c);
        $search =  null;
        $showr = null;
        if ($request) {
            $search = $request->search;
            $min_r = (isset($request->price[0])) ? $request->price[0] : 0;
            $max_r = (isset($request->price[1])) ? $request->price[1] : 100;
        }
        
        $products = Products::with('images')
                            ->where('type', 'Souvenirs')
                            ->search(trim($request->search))
                            ->price($min_r,$max_r);
        if ($request->show) {
            $products = $products->where('del',false)->get();
            $showr = $request->show;
        }else{
            $products = $products->where('del',false)->paginate(8);
        }

        $products_responsives = Products::with('images', 'activities')
                            ->where('del',false)
                            ->where('type', 'Souvenirs')->get();
        $count= $products_responsives->count();
        $max = $products_responsives->max('price');

        return Inertia::render('Shop/Souvenirs', compact('products', 'max', 'search', 'min_r', 'max_r', 'count', 'showr'));
    }
    public function about(Request $request)
    {
        $this->handle_auth($request->h);
        $this->handle_auth_c($request->c);
        return Inertia::render('Statics/AboutUs');
    }
    public function contact(Request $request)
    {
        $this->handle_auth($request->h);
        $this->handle_auth_c($request->c);
        return Inertia::render('Statics/ContactUs');
    }
    public function contact_mail(Request $request)
    {
        

        $validator = $this->validate($request, [
            'firstname'         => 'required|string',
            'lastname'          => 'required|string',
            'phone'             => 'required',
            'subject'           => 'required',
            'message'           => 'required',
            'contact'           => 'required',
            'email'             => 'required|string|email|max:255|unique:users',
        ]);
        $data = array(
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'type' => $request->contact,
        );
        
        Mail::to('xpestana4@gmail.com')->send(new ContactReceived($data));
        $pin = mt_Rand(1000000, 9999999);
        return back()->with(['id'=>$pin, 'message' => 'Mensaje enviado con exito', 'code' => 200, 'status' => 'success']);
    }
    /**
     * Muestra los codigos QR del hotel.
     *
     * @return \Illuminate\Http\Response
     */
    public function qr()
    {
        $hotel = hotel::find(auth()->user()->hotel->first()->id);
        $url = "https://hicitty.com/";
        $client = $hotel->user()->wherePivot('manager', false)->first();
        
        return Inertia::render('Dashboard/Qr', compact('url', 'client'));
    }
}
