<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Inertia\Inertia;
use Carbon\Carbon;
use Redirect;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->quantity)
            $quantity = $request->quantity;
        else
            $quantity = 1;
        $product = Products::find($id)->load('images');
        $pin = mt_Rand(1000000, 9999999);
        $cartQuantity = (Cart::get($product->id)) ? Cart::get($product->id)->quantity : 0;
        if ($product->stock >= $request->quantity + $cartQuantity) {
            $addCart = \Cart::add(array(
                'id' => $product->id,
                'name'=>$product->title,
                'price'=> $product->price,
                'quantity' => $quantity,
                'attributes' => array(
                    'url' => $product->images[0]->url,
                    'type' => 'souvenir'
                    ),
                'associatedModel' => $product
            ));
        
            return back()->with(['mensaje' => '<i class="fas fa-check mr-1"></i> Artículo añadido a tu cesta']);  
        }else{
            return back()->with(['mensaje' => 'Lo sentimos, no tenemos más stock de este producto']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->update) {
            Cart::update($id, array(
                'quantity' => -1, 
            ));
        }else{
            Cart::remove($id);
        }
        $pin = mt_Rand(1000000, 9999999);
        return back()->with(['id'=>$pin, 'mensaje' => 'Producto eliminado exitosamente']);  
    }
    public function activity(Request $request)
    {
        $datetime = new Carbon($request->date);
        $product = Products::find($request->product_id)->load('images');
        $image = null;
        if($product->image){
            $image = $product->images[0]->url;
        }
        $addCart = \Cart::add(array(
            'id' => $product->id,
            'name'=>$product->title,
            'price'=> 20,
            'quantity' => 1,
            'attributes' => array(
                'type' => 'activity',
                'url' => $image,
                'date' => $request->fecha,
                'pedido' => $request->pedido,
                ),
            'associatedModel' => $product
        ));
        $pin = mt_Rand(1000000, 9999999);
        return back()->with(['mensaje' => '<i class="fas fa-check mr-1"></i> Artículo añadido a tu cesta']);  
    }
}
