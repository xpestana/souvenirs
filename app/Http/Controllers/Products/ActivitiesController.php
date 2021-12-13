<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Images;
use Inertia\Inertia;
use Redirect;
use Image;


class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::where("type", "Activities")->where('del',false)->with('images', 'activities')->get();

        return Inertia::render('Dashboard/Activities', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Dashboard/Create/Activities');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'category'      => 'required',
            'title'         => 'required|string|max:255',
            'precioA'        => 'required',
            'description'   => 'required',
            'fechaI'         => 'required',
            'iframe'         => 'required',
            'featured'      => 'required',
        ]);

        $activities = Products::create([
                    'type' => 'Activities',
                    'title' => $request->title,
                    'description' => $request->description,
                    'featured' => $request->featured,
                    ]);

        $activities->categories()->attach($request->category);

        $activities->activities()
                        ->create([
                            'priceA' => $request->precioA,
                            'priceN' => $request->precioN,
                            'init' => $request->fechaI,
                            'end' => $request->fechaF,
                            'details' => $request->details,
                            'iframe' => $request->iframe,
                        ]);
        $id= $activities->id;
        $cookie = Cookie::make('product_id', $id, 5);
        return back()->with(['id'=>$id, 'message' => 'Agregado con exito, Espere un momento porfavor', 'code' => 200, 'status' => 'success'])->cookie($cookie); 
    }
    /**
     * Cambias nombres de los archivos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function FileName($file)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $images=array("jpg", "jpeg", "png");
        
        $pin = mt_Rand(1000000, 9999999)
               . mt_Rand(1000000, 9999999)
               . $characters[Rand(0, strlen($characters) - 1)];
        
        $nameFile = $file->getClientOriginalName();

        $extension = pathinfo($nameFile, PATHINFO_EXTENSION);
        $fileName  = 'file_'.$pin.'.'.$extension;

        $response = [
            'extension' => $extension,
            'fileName' => $fileName,
        ];

        return $response;
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function image(Request $request)
    {
        $product_id = $request->cookie('product_id');
        $product = Products::find($product_id);

        foreach($request->file as $file){
            $Path = public_path('storage/souvenirs/');
            $pathName = '/';
            if (!file_exists($Path)) {
                mkdir($Path, 777, true);
            }
            $nameFile =$this->FileName($file); //nombre de archivo original
            $imgFileOriginal = Image::make($file->getRealPath());
            $imgFileOriginal->save($Path.$nameFile['fileName']);

            Images::create([
                'products_id'   => $product->id,
                'name'          => $nameFile['fileName'],
                'url'           => $pathName.$nameFile['fileName'],
            ]);
        }
        $cookie = Cookie::expire('product_id');
        return back(); 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::with('images', 'activities')->where('id', $id)->first();

        return Inertia::render('Dashboard/Show/Activities', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::with('images', 'activities')->where('id', $id)->first();

        return Inertia::render('Dashboard/Edit/Activities', compact('product'));
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
        $validator = $this->validate($request, [
            'title'         => 'required|string|max:255',
            'precioA'        => 'required',
            'description'   => 'required',
            'fechaI'         => 'required',
            'iframe'         => 'required',
            'featured'      => 'required',
        ]);

        $activities = Products::find($id);
        $activities->title = $request->title;
        $activities->description = $request->description;
        $activities->featured = $request->featured;
        $activities->save();

        $activities->activities()
                        ->update([
                            'priceA' => $request->precioA,
                            'priceN' => $request->precioN,
                            'init' => $request->fechaI,
                            'end' => $request->fechaF,
                            'details' => $request->details,
                            'iframe' => $request->iframe,
                        ]);

        if ($request->category) {
            $activities->categories()->sync($request->category);
        }

        $id= $activities->id;
        $cookie = Cookie::make('product_id', $id, 5);
        return back()->with(['id'=>$id, 'message' => 'Actualizado con exito', 'code' => 200, 'status' => 'success'])->cookie($cookie); 
    }
    public function updt_image(Request $request)
    {
        Images::where('products_id', $request->id)->delete();

        $product = Products::find($request->id);
        
        foreach($request->file as $file){

            $Path = public_path('storage/souvenirs/');
            $pathName = '/';

            if (!file_exists($Path)) {
                mkdir($Path, 777, true);
            }

            $nameFile =$this->FileName($file); //nombre de archivo original
            $imgFileOriginal = Image::make($file->getRealPath());
            $imgFileOriginal->save($Path.$nameFile['fileName']);

            Images::create([
                'products_id'   => $product->id,
                'name'          => $nameFile['fileName'],
                'url'           => $pathName.$nameFile['fileName'],
            ]);

        }

        return back(); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->del = true;
        $product->save();
        
        return Redirect::route('activities.index')->with(['id'=>$id, 'message' => 'Success', 'code' => 200, 'status' => 'success']);    
    }
}
