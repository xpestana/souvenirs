<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\Categories;
use App\Models\Products;
use App\Models\Settings;
use Illuminate\Support\Arr;
use Cart;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {  
        $categories = [];
        foreach(Categories::all() as $category){
            $cat = ["value"=> $category->id, "label"=> $category->name];
            $categories = Arr::prepend($categories, $cat);
            
        }
        return array_merge(parent::share($request), [
            'auth.user' => fn() => auth()->user() ? auth()->user() : null,
            'auth.profile' => fn() => auth()->user() ? auth()->user()->profile : null,
            'auth.role' => fn() => auth()->user() ? auth()->user()->getRoleNames()->first() : null,
            'cart' => fn() => Cart::getContent(),
            'settings' => fn() => Settings::where('active',1)->first(),
            'cart.total' => fn() => Cart::getTotal(),
            'cart.count' => fn() => Cart::getTotalQuantity(),
            'souvenirs' => Products::with('images')
                                    ->where('del',false)
                                    ->where('type', 'Souvenirs')
                                    ->limit(12)->get(),
            'activities' => Products::with('images', 'activities')
                                    ->where('del',false)
                                    ->where('type', 'Activities')
                                    ->limit(12)->get(),
            'flash' => [
                'id' => fn () => $request->session()->get('id'),
                'message' => fn () => $request->session()->get('message'),
                'code' => fn () => $request->session()->get('code'),
                'status' => fn () => $request->session()->get('status'),
                'mensaje' => fn () => $request->session()->get('mensaje'),
            ],
    ]);
    }
}
