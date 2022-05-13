<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\hotel;
use App\Models\User;
use App\Models\Products;
use Inertia\Inertia;
use Redirect;
use Image;

class ProductsController extends Controller
{
    public function souvenirs($id)
    {
        $product = Products::with('images')->where('id', $id)->first();

        return Inertia::render('Dashboard/Show/Souvenirs', compact('product'));
    }
    public function activities($id,Request $request)
    {
        $product = Products::with('images', 'activities')->where('id', $id)->first();
        $access_token = connect()['access_token'];
        
        $prices = [];
        if($request->event_time){
            $prices = Http::post('https://app.turitop.com/v1/tickets/getprices', [
                'access_token'   => connect()['access_token'],
                'data' => [
                    "product_short_id" => $request->short_id,
                    "date_event"=> $request->event_time,
                    'language_code'=> "es"
                ]
            ])->collect(); 
            if(isset($prices['data'])){

                $prices = $prices['data'];
            }
        }
        
        return Inertia::render('Dashboard/Show/Activities', compact('product','access_token','prices'));
    }
}
