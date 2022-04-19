<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Products;
use App\Models\Images;
use Inertia\Inertia;
use Redirect;
use Image;

class SouvenirsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::where("type", "Souvenirs")->where('del',false)->with('images')->get();

        return Inertia::render('Dashboard/Souvenirs', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Dashboard/Create/Souvenirs');
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
            'precio'        => 'required|numeric',
            'description'   => 'required',
            'featured'      => 'required',
            'stock'      => 'required|numeric',
            'category'      => 'required',
        ]);
        if ($request->precio < $request->offer) {
            return back()->with(['id'=>400, 'message' => 'El precio de oferta debe ser menor que el precio normal', 'code' => 400, 'status' => 'error']);
        }
        
        $image = $request->image;
        if ($image) {
            $msg =$this->valid($image);

            if ($msg['code']=='404')   return back()->with(['id'=>$msg['id'], 'message' => $msg['msg'], 'code' => $msg['code'], 'status' => 'error']);
        }
        

        try {
            $id = mt_Rand(1000000, 9999999);
            
            $user = auth()->user();

            $Path = public_path('storage/souvenirs/');
            $pathName = '/';

            if (!file_exists($Path)) {
                mkdir($Path, 777, true);
            }

            if ($image) {
                $nameFile =$this->FileName($image); //nombre de archivo original
                $imgFileOriginal = Image::make($image->getRealPath());
                $imgFileOriginal->save($Path.$nameFile['fileName']);
                $name_file = $nameFile['fileName'];
            }else{
                $name_file ="default.jpg";
            }

        $souvenir = Products::create([
                'type' => 'Souvenirs',
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->precio,
                'stock' => $request->stock,
                'featured' => $request->featured,
                'offer' => $request->offer,
                'category' => $request->category,
            ]);

        Images::create([
                'products_id'   => $souvenir->id,
                'name'          => $name_file,
                'url'           => $pathName.$name_file,
            ]);
        $id= $souvenir->id;
        $cookie = Cookie::make('product_id', $id, 5);
        return back()->with(['id'=>$id, 'message' => 'Agregado con exito, Espere un momento porfavor', 'code' => 200, 'status' => 'success'])->cookie($cookie); 
        } catch (Exception $e) {
                
        }
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

    public function valid($file)
    {
        if ($file) {
            /*** Extraccion de la extension ***/
            $nameFile = $file->getClientOriginalName();
            $extension = pathinfo($nameFile, PATHINFO_EXTENSION);
            $id = mt_Rand(1000000, 9999999);

            $images=array("JPG", "JPEG", "PNG");
            if (!in_array(strtoupper($extension), $images)) {
                return ['id' => $id, 'code' => 404, 'msg' => 'Formato de imagen incorrecto', 'status' => 'error'];
            }
            
            $response = [
                'id' => $id,
                'code' => 200,
                'msg' => 'Acepted'
            ];
            return $response;
        }
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
        $product = Products::with('images')->where('id', $id)->first();

        return Inertia::render('Dashboard/Show/Souvenirs', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::with('images')->where('id', $id)->first();

        return Inertia::render('Dashboard/Edit/Souvenirs', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->validate($request, [
            'title'         => 'required|string|max:255',
            'precio'        => 'required',
            'description'   => 'required',
            'stock'      => 'required',
            'category'      => 'required',
        ]);
        if ($request->precio < $request->offer) {
            return back()->with(['id'=>400, 'message' => 'El precio de oferta debe ser menor que el precio normal', 'code' => 400, 'status' => 'error']);
        }
                      
        $souvenir = Products::find($request->souvenir);
        $souvenir->title = $request->title;
        $souvenir->price = $request->precio;
        $souvenir->description = $request->description;
        $souvenir->featured = $request->featured;
        $souvenir->stock = $request->stock;
        $souvenir->offer = $request->offer;
        $souvenir->category = $request->category;
        $souvenir->save();

        if ($request->image) {
            $this->updt_image($souvenir->id, $request->image);
        }

        $id= $souvenir->id;
        $cookie = Cookie::make('product_id', $id, 5);
        return back()->with(['id'=>$id, 'message' => 'Actualizado con exito', 'code' => 200, 'status' => 'success'])->cookie($cookie); 
    }
    public function updt_image($id, $file)
    {
        Images::where('products_id', $id)->delete();

        $product = Products::find($id);
        
//        foreach($files as $file){

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

    //    }

        //return back(); 
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
        
        return Redirect::route('admin.souvenirs')->with(['id'=>$id, 'message' => 'Success', 'code' => 200, 'status' => 'success']);    
    }
}
