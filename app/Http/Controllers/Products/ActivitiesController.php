<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
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
        $products = Http::post('https://apptest.turitop.com/v1/product/getproducts', [
                        'access_token'   => connect()['access_token'],
                        'data' => [
                                    'language_code: es'
                                ]
                    ])->collect()['data']['products'];
//        dd($products);
        return Inertia::render('Dashboard/Activities', compact('products'));
    }
    
    public function activities()
    {
        $products = Http::post('https://apptest.turitop.com/v1/product/getproducts', [
            'access_token'   => connect()['access_token'],
            'data' => [
                        'language_code: es'
                    ]
        ])->collect()['data']['products'];
        $actList = Products::where("short_id","<>","null")
                            ->where("del","0")                        
                            ->get();
        return Inertia::render('Admin/Activities', compact('products','actList'));
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
    public function update(Request $request, $activities)
    {
            $product = Products::where("short_id", $activities)->first();

            try {
                if($product){

                    if($product->del == 0){
                        $product->del = 1;
                        $product->save();
                    }else{
                        $product->del = 0;
                        $product->save();
                    }
                
                }else{
                    $product = Products::create([
                        'type' => 'Activities',
                        'title' => $request->name,
                        'description' => ($request->description) ? $request->description: $request->summary,
                        'featured' => false,
                        'category' => $request->type,
                        'short_id' => $request->short_id,
                        'summary' => $request->summary,
                        ]);

                    $product->activities()
                        ->create([
                            'details' => ($request->pricing_notes) ? $request->pricing_notes: $request->summary,
                            'flow' => $request->flow,
                            'duration' => $request->duration,
                            'coordinates' => $request->coordinates,
                        ]);

                if (!empty($request->images)) {
                    foreach($request->images as $image){
                        Images::create([
                            'products_id'   => $product->id,
                            'name'          => $image['url'],
                            'url'           => $image['url'],
                        ]);
                    }
                }
                }
            } catch (Exception $e) {
                return back()->with(['id'=>400, 'message' => 'Ocurrio un error intente denuevo', 'code' => 400, 'status' => 'error']);     
            }
            
        return back()->with(['id'=>$activities, 'message' => 'Actualizado con exito', 'code' => 200, 'status' => 'success']); 
        
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
