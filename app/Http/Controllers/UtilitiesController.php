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
        $user = User::find($id);
        if ($user) {
            if ($user->getRoleNames()->first() == "Client") {
                $auth = Auth::login($user, true);
            }
        }
        return 0;        
    }
    public function home(Request $request)
    {
        $this->handle_auth($request->h);
        return Inertia::render('Statics/Home');
    }
    public function activities(Request $request)
    {
        $this->handle_auth($request->h);
        $search =$category =  null;
        if ($request) {
            $search = $request->search;
            $category = $request->category;
            $min = (isset($request->price[0])) ? $request->price[0] : null;
            $max = (isset($request->price[1])) ? $request->price[1] : null;
        }

        //dd($request->all());
        $products = Products::with('images', 'activities')
                            ->where('del',false)
                            ->where('type', 'Activities')
                            ->search(trim($request->search))
                            ->Cat($request->category)
                            ->priceA($min,$max)
                            ->inRandomOrder()
                            ->paginate(20);

        $max = $products->max('activities.priceA')+($products->max('activities.priceA')*2);

        return Inertia::render('Shop/Tours', compact('products', 'max', 'search', 'category'));
    }


    public function souvenirs(Request $request)
    {
        $this->handle_auth($request->h);
        //$request->all();
        $search =$category =  null;
        if ($request) {
            $search = $request->search;
            $category = $request->category;
            $min = (isset($request->price[0])) ? $request->price[0] : null;
            $max = (isset($request->price[1])) ? $request->price[1] : null;
        }

        $products = Products::with('images')
                            ->where('del',false)
                            ->where('type', 'Souvenirs')
                             ->search(trim($request->search))
                            ->Cat($request->category)
                            ->price($min,$max)
                            ->inRandomOrder()
                            ->paginate(20);

        $max = $products->max('price')+($products->max('price')*2);

        return Inertia::render('Shop/Souvenirs', compact('products', 'max', 'search', 'category'));
    }
    public function about(Request $request)
    {
        $this->handle_auth($request->h);
        return Inertia::render('Statics/AboutUs');
    }
    public function contact(Request $request)
    {
        $this->handle_auth($request->h);
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
        $url = env('APP_URL');
        $client = $hotel->user()->wherePivot('manager', false)->first();
        
        return Inertia::render('Dashboard/Qr', compact('url', 'client'));
    }
}
