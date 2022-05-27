<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Activities;
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
        $products = Http::post('https://app.turitop.com/v1/product/getproducts', [
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
        $products = Http::post('https://app.turitop.com/v1/product/getproducts', [
            'access_token'   => connect()['access_token'],
            'data' => [
                        'language_code: es'
                    ]
        ])->collect()['data']['products'];
        $actList = Products::where("short_id","<>","null")
                            ->where("del","0")                        
                            ->get();
        
        $activities = Products::with('activities')->where('type', 'Activities')->where('del', false)->paginate(8);

        return Inertia::render('Admin/Activities', compact('products','actList','activities'));
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
        //
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
    public function show(Request $request, $id)
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
        $product = Products::with('images', 'activities')->where('id', $id)->first();

        return Inertia::render('Admin/Activities/Edit', compact('product'));
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
                    $today = now();
                    $week = date("d-m-Y",strtotime($today."+ 2 month"));
                    

                    $events = Http::post('https://app.turitop.com/v1/product/tour/getevents', [
                        'access_token'   => connect()['access_token'],
                        'data' => [
                            "product_short_id" => $request->short_id,
                            "start_date"=> strtotime($today),
                            "end_date"=> strtotime($week),
                            'language_code'=> "es"
                        ]
                    ])->collect();

                    if(isset($events['data']['events'])){
                        $events = $events['data']['events'];
                    }
            
                    $prices=null;
                    if(isset($events[0])){
                        $prices = Http::post('https://app.turitop.com/v1/tickets/getprices', [
                        'access_token'   => connect()['access_token'],
                        'data' => [
                            "product_short_id" => $request->short_id,
                            "date_event"=> $events[0]['time'],
                            'language_code'=> "es"
                        ]
                        ])->collect();

                        if(isset($prices['data'])){
                            $prices = $prices['data'];
                        }
                    }
                    
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
                            'priceA' => $prices,
                            'duration' => $request->duration,
                            'coordinates' => $request->coordinates,
                            'priceA' => json_encode($prices),
                            'events' => json_encode($events),
                            'price_notes' => $request->pricing_notes,
                            'language' => "Español",
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
    public function updt(Request $request, $activities)
    {

        $arr = [
            "prices_per_ticket" => [
                
            ]
        ];
        $i = 0;
        foreach ($request->pricesArr as $arrayPrice) {
            $arr['prices_per_ticket']["111".$i] = $arrayPrice;

            $i++;
        }

        $product = Products::find($activities);
        $product->description = $request->description;
        $product->title = $request->title;
        $product->save();

        $activities = Activities::find($product->activities->id);
        $activities->language = $request->language;
        $activities->priceA = json_encode($arr);
        $activities->save();

        return back()->with(['id'=>$product->id, 'message' => 'Success', 'code' => 200, 'status' => 'success']);  
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Products::find($request->id);
        $product->del = true;
        $product->save();
        
        return Redirect::route('activities.index')->with(['id'=>$product->id, 'message' => 'Success', 'code' => 200, 'status' => 'success']);    
    }
    /*update API*/
    public function api()
    {
        $today = now();
        $week = date("d-m-Y",strtotime($today."+ 2 month"));

        /*Español*/

        $products = Http::post('https://app.turitop.com/v1/product/getproducts', [
            'access_token'   => connect()['access_token'],
            'data' => [
                        'language_code'=> "es"
                    ]
        ])->collect()['data']['products'];
        
        foreach($products as $product){
            
            $p = Products::where("short_id", $product['short_id'])->first();
            
            $events = Http::post('https://app.turitop.com/v1/product/tour/getevents', [
                        'access_token'   => connect()['access_token'],
                        'data' => [
                            "product_short_id" => $product['short_id'],
                            "start_date"=> strtotime($today),
                            "end_date"=> strtotime($week),
                            'language_code'=> "es"
                        ]
                    ])->collect();
            if(isset($events['data']['events'])){
                $events = $events['data']['events'];
            }
            $prices=null;
            if(isset($events[0])){
                $prices = Http::post('https://app.turitop.com/v1/tickets/getprices', [
                    'access_token'   => connect()['access_token'],
                    'data' => [
                        "product_short_id" => $product['short_id'],
                        "date_event"=> $events[0]['time'],
                        'language_code'=> "es"
                    ]
                ])->collect();
                if(isset($prices['data'])){
                    $prices = $prices['data'];
                }
            }

                if($p){
                    $p->type = 'Activities';
                    $p->category = $product['type']['name'];
                    $p->short_id = $product['short_id'];
                    $p->summary = html_entity_decode($product['summary']);
                    $p->save();

                    $p->activities()
                        ->update([
                            'details' => ($product['pricing_notes'] != '') ? html_entity_decode($product['pricing_notes']): html_entity_decode($product['summary']),
                            'flow' => $product['flow'],
                            'duration' => $product['duration'],
                            'coordinates' => $product['coordinates'],
                            'price_notes' => $product['pricing_notes'],
                            'events' => json_encode($events),
                        ]);

                if (!empty($product['images'])) {
                    foreach($product['images'] as $image){
                        $p->images()->update([
                            'name'          => $image['url'],
                            'url'           => $image['url'],
                        ]);
                    }
                }
                }else{

                    $prod = Products::create([
                        'type' => 'Activities',
                        'title' => html_entity_decode($product['name']),
                        'description' => ($product['description'] != '') ? html_entity_decode($product['description']): html_entity_decode($product['summary']),
                        'featured' => false,
                        'category' => $product['type']['name'],
                        'short_id' => $product['short_id'],
                        'summary' => html_entity_decode($product['summary']),
                        ]);

                    $prod->activities()
                        ->create([
                            'details' => ($product['pricing_notes'] != '') ? html_entity_decode($product['pricing_notes']): html_entity_decode($product['summary']),
                            'flow' => $product['flow'],
                            'duration' => $product['duration'],
                            'coordinates' => $product['coordinates'],
                            'priceA' => json_encode($prices),
                            'events' => json_encode($events),
                            'price_notes' => $product['pricing_notes'],
                            'language' => "Español",
                        ]);

                if (!empty($product['images'])) {
                    foreach($product['images'] as $image){
                        Images::create([
                            'products_id'   => $prod->id,
                            'name'          => $image['url'],
                            'url'           => $image['url'],
                        ]);
                    }
                }
                }
        }
        
         /*Ingles*/
        
        $products = Http::post('https://app.turitop.com/v1/product/getproducts', [
            'access_token'   => connect()['access_token'],
            'data' => [
                        'language_code'=> "en"
                    ]
        ])->collect()['data']['products'];
        
        foreach($products as $product){
            
            $p = Products::where("short_id", $product['short_id'])->first();
            
            $events = Http::post('https://app.turitop.com/v1/product/tour/getevents', [
                        'access_token'   => connect()['access_token'],
                        'data' => [
                            "product_short_id" => $product['short_id'],
                            "start_date"=> strtotime($today),
                            "end_date"=> strtotime($week),
                            'language_code'=> "en"
                        ]
                    ])->collect();
            if(isset($events['data']['events'])){
                $events = $events['data']['events'];
            }
            $prices=null;
            if(isset($events[0])){
                $prices = Http::post('https://app.turitop.com/v1/tickets/getprices', [
                    'access_token'   => connect()['access_token'],
                    'data' => [
                        "product_short_id" => $product['short_id'],
                        "date_event"=> $events[0]['time'],
                        'language_code'=> "en"
                    ]
                ])->collect();
                if(isset($prices['data'])){
                    $prices = $prices['data'];
                }
            }

                if($p){
                    $p->type = 'Activities';
                    if(is_null($p->title_en)){
                        $p->title_en = html_entity_decode($product['name']);    
                    }
                    if(is_null($p->description_en)){
                        $p->description_en = ($product['description'] != '') ? html_entity_decode($product['description']): html_entity_decode($product['summary']);
                    }
                    $p->category = $product['type']['name'];
                    $p->short_id = $product['short_id'];
                    $p->summary_en = html_entity_decode($product['summary']);
                    $p->save();

                    $p->activities()
                        ->update([
                            'details_en' => ($product['pricing_notes'] != '') ? html_entity_decode($product['pricing_notes']): html_entity_decode($product['summary']),
                            'flow' => $product['flow'],
                            'price_en' => json_encode($prices),
                            'duration' => $product['duration'],
                            'coordinates' => $product['coordinates'],
                            'price_notes_en' => $product['pricing_notes'],
                            'events_en' => json_encode($events),
                        ]);

                if (!empty($product['images'])) {
                    foreach($product['images'] as $image){
                        $p->images()->update([
                            'name'          => $image['url'],
                            'url'           => $image['url'],
                        ]);
                    }
                }
                }else{

                    $prod = Products::create([
                        'type' => 'Activities',
                        'title_en' => html_entity_decode($product['name']),
                        'description_en' => ($product['description'] != '') ? html_entity_decode($product['description']): html_entity_decode($product['summary']),
                        'featured' => false,
                        'category' => $product['type']['name'],
                        'short_id' => $product['short_id'],
                        'summary_en' => html_entity_decode($product['summary']),
                        ]);

                    $prod->activities()
                        ->create([
                            'details_en' => ($product['pricing_notes'] != '') ? html_entity_decode($product['pricing_notes']): html_entity_decode($product['summary']),
                            'flow' => $product['flow'],
                            'duration' => $product['duration'],
                            'coordinates' => $product['coordinates'],
                            'price_en' => json_encode($prices),
                            'events_en' => json_encode($events),
                            'price_notes_en' => $product['pricing_notes'],
                            'language' => "Español",
                        ]);

                if (!empty($product['images'])) {
                    foreach($product['images'] as $image){
                        Images::create([
                            'products_id'   => $prod->id,
                            'name'          => $image['url'],
                            'url'           => $image['url'],
                        ]);
                    }
                }
                }
        }
      return back()->with(['id'=>200, 'message' => 'Actualizado con exito', 'code' => 200, 'status' => 'success']); 
    }
}
