<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Mail\SaleSouvenirReceived;
use App\Mail\FeedbackReceived;
use App\Mail\WelcomeReceived;
use App\Mail\DisplayReceiver;
use App\Models\hotel;
use App\Models\User;
use App\Models\Order;
use App\Models\profile;
use App\Models\CollaboratorShipping;
use App\Models\CollaboratorBank;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Auth\Events\Registered;
use Redirect;
use Image;

class CollaboratorController extends Controller
{
    public function home()
    { 
        /*Redirección si no tiene perfil*/
        if (auth()->user()->profile == null) {
            return Redirect::route('collaborator.data');
        }
        /*******************************/
        $url = config('app.url');
        $cont = step();
        $hotels = auth()->user()->hotel->load('orders.shippings');
        $orders = Order::whereIn('hotel_id',$hotels->pluck('id'))->where("status","complete")
                    ->with('hotel','shippings')->get();
        return Inertia::render('Collaborator/Dashboard/Home', compact('cont','hotels','url','orders'));
    }
    public function feedback(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);
        $id = mt_Rand(1000000, 9999999);
        $user = auth()->user();
        $details = $request->description;
        Mail::to("info@hicitty.es")->send(new FeedbackReceived($user,$details));
    
    return Redirect::route('collaborator.dashboard.home')->with(['id'=>$id, 'message' => 'Enviado con exito', 'code' => 200, 'status' => 'success']);
    }
    public function profile()
    {
        return Inertia::render('Collaborator/Dashboard/Profile/Welcome');
    }

    public function profile_info()
    { 
        return Inertia::render('Collaborator/Dashboard/Profile/Information');
    }

    public function profile_tax()
    {
        return Inertia::render('Collaborator/Dashboard/Profile/Tax');
    }

   
    
    public function create()
    {
        return Inertia::render('Collaborator/RegisterForm');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users|confirmed',
            'password' => 
            ['required', 
                Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->uncompromised()
            ],
        ]);

        $user = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Mail::to($user->email)->send(new WelcomeReceived($user, $request->password));

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function data()
    {
        return Inertia::render('Collaborator/Data');
    }

    public function index()
    {
        /*Redirección si no tiene perfil*/
        if (auth()->user()->profile == null) {
            return Redirect::route('collaborator.data');
        }
        /*******************************/
        
        $hotels = auth()->user()->hotel()->paginate(3);
        $hotels->load('orders.shippings');
        $url = config('app.url');
        
        return Inertia::render('Collaborator/Dashboard/Lodging/Index', compact('hotels','url'));
    }
    public function register_data(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'gestor' => 'required|string',
        ]);

        $user = profile::create([
            'user_id' => auth()->user()->id,
            'firstname' => $request->name,
            'phone' => $request->phone,
            'gestor' => $request->gestor,
            'razon' => $request->razon,
            'nif' => $request->nif,
            'identify' => $request->id,
            'city' => $request->city,
            'cp' => $request->cp,
            'address' => $request->address,
        ]);
        $user = User::find(auth()->user()->id);
        if ($request->gestor == 1) {
            $user->assignRole('Hotel');
            return Redirect::route('collaborator.dashboard.home')->with(['id'=>auth()->user()->id, 'message' => 'Registro exitoso', 'code' => 200, 'status' => 'success']);
        }
        if ($request->gestor == 2) {
            $user->assignRole('Associate');

            $userClient = User::create([
                'name' => $user->email,
                'email' => $user->email.$user->id,
                'password' => Hash::make("user12345client"),
            ]);

            $userClient->assignRole('Client');
            return Redirect::route('associates.index')->with(['id'=>auth()->user()->id, 'message' => 'Registro exitoso', 'code' => 200, 'status' => 'success']);
        }
    }
    public function request_display(Request $request){
        $user = auth()->user();
        Mail::to("info@hicitty.es")->send(new DisplayReceiver($user));
        return back();
    }
    public function create_hab()
    {
        return Inertia::render('Collaborator/Dashboard/Lodging/Create');
    }
    /**
     * Validaciones.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
    public function store_hab(Request $request)
    {
        if($request->tipo == 'hotel'){
            $request->validate([
                'tipo' => 'required|string',
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'code' => 'nullable|string',
                'cp' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
                'province' => 'required|string',
                'group' => 'required|string',
                'modality' => 'required|string',
                'category' => 'required|string',
            ]);
        }
        if ($request->tipo == 'apartamento') {
            $request->validate([
                'tipo' => 'required|string',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'address' => 'nullable|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'cp' => 'nullable|string',
                'code' => 'nullable|string',
                'url' => 'required|url',
                'area' => 'nullable|string',
            ]);
        }
        if ($request->tipo == 'complejo') {
            $request->validate([
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'nllaves' => 'required|string',
                'tipo' => 'required|string',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'cp' => 'nullable|string',
                'code' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
            ]);
        }
        $image = $request->image;
        if ($image) {
            $msg =$this->valid($image);

            if ($msg['code']=='404')   return back()->with(['id'=>$msg['id'], 'message' => $msg['msg'], 'code' => $msg['code'], 'status' => 'error']);
        }

        try {
            $id = mt_Rand(1000000, 9999999);
            
            $user = auth()->user();

            $Path = public_path('storage/hotel/');
            $pathName = '/';

            if (!file_exists($Path)) {
                mkdir($Path, 777, true);
            }
            if ($image) {
                /*$nameFile =$this->FileName($image); //nombre de archivo origin
                $imgFileOriginal = Image::make($image->getRealPath());
                $imgFileOriginal->save($Path.$nameFile['fileName']);
                $name_file = $nameFile['fileName'];*/
                $name_file = time() . '-' . $image->getClientOriginalName();
                $uploadSuccess = $image->move($Path, $name_file);
            }else{
                $name_file ="default.jpg";
            }
        
            $hotel = hotel::create([
                'name'        => $request->nombre_hotel ?? null,
                'hab'         => $request->numero_habitaciones ?? null,
                'calle'       => $request->calle,
                'type'        => $request->tipo,
                'address'     => $request->address ?? null,
                'zone'        => $request->city,
                'planta'      => $request->planta,
                'cp'          => $request->cp ?? null,
                'code'        => $request->code,
                'url'         => $request->url,
                'area'        => $request->area,
                'image'       => $pathName.$name_file,
                'province'    => $request->province,
                'group'       => $request->group,
                'modality'    => $request->modality,
                'category'    => $request->category,
                'nllaves'     => $request->nllaves ?? null,
            ]);
            $clientUser = User::create([
                'name' => auth()->user()->email,
                'email' => auth()->user()->email.$hotel->id,
                'password' => Hash::make("usuario123456"),
            ]);
            
            $user->hotel()->attach($hotel->id, ['manager' => true]);
            
            $clientUser->assignRole('Client');
            $clientUser->hotel()->attach($hotel->id, ['manager' => false]);

        return Redirect::route('coll.lodgings.index')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
        } catch (Exception $e) {
            
        }
    }

    public function edit_hab($id){

        $hotel = hotel::find($id)->load('orders.shippings');
        $url = config('app.url');
        return Inertia::render('Collaborator/Dashboard/Lodging/Edit',compact('hotel','url'));
    }

    public function update_hab($id,Request $request){
            
        if($request->tipo == 'hotel'){
            $request->validate([
                'tipo' => 'required|string',
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'code' => 'nullable|string',
                'cp' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
                'province' => 'required|string',
                'group' => 'required|string',
                'modality' => 'required|string',
                'category' => 'required|string',
            ]);
        }
        if ($request->tipo == 'apartamento') {
            $request->validate([
                'tipo' => 'required|string',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'address' => 'nullable|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'cp' => 'nullable|string',
                'code' => 'nullable|string',
                'url' => 'required|url',
                'area' => 'nullable|string',
            ]);
        }
        if ($request->tipo == 'complejo') {
            $request->validate([
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'nllaves' => 'required|string',
                'tipo' => 'required|string',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'cp' => 'nullable|string',
                'code' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
            ]);
        }

        try{
            
            if ($request->file('image')) {
                $image = $request->image;
                $msg =$this->valid($image);
                if ($msg['code']=='404')   return back()->with(['id'=>$msg['id'], 'message' => $msg['msg'], 'code' => $msg['code'], 'status' => 'error']);

                $Path = public_path('storage/hotel/');
                $pathName = '/';

                if (!file_exists($Path)) {
                    mkdir($Path, 777, true);
                }

                /*$nameFile =$this->FileName($image); //nombre de archivo original
                $imgFileOriginal = Image::make($image->getRealPath());
                $imgFileOriginal->save($Path.$nameFile['fileName']);*/
                $name_file = time() . '-' . $image->getClientOriginalName();
                $uploadSuccess = $image->move($Path, $name_file);

            }
            $hotel = hotel::find($id);
            $hotel->name = $request->nombre_hotel ?? null;
            $hotel->hab  = $request->numero_habitaciones ?? null;
            $hotel->calle = $request->calle;
            $hotel->address = $request->address ?? null;
            $hotel->zone = $request->city;
            $hotel->planta = $request->planta;
            $hotel->cp = $request->cp ?? null;
            $hotel->code = $request->code;
            $hotel->url = $request->url;
            $hotel->area = $request->area;
            $hotel->province = $request->province;
            $hotel->group = $request->group;
            $hotel->modality = $request->modality;
            $hotel->category = $request->category;
            $hotel->nllaves = $request->nllaves ?? null;
            if ($request->file('image')) {
                $hotel->image = $pathName.$name_file;
            }
            $hotel->save();
            return Redirect::route('coll.lodgings.index')->with(['id'=>$id, 'message' => 'Actualizado exitosamente', 'code' => 200, 'status' => 'success']);   
         }catch (Exception $e) 
         {
        
         }
    }
    //resources

    public function resource_welcome(){
        return Inertia::render('Collaborator/Dashboard/Resource/Welcome');
    }
    public function resource_stay(){
        return Inertia::render('Collaborator/Dashboard/Resource/Stay');
    }
    // Sales

    public function sales_welcome(){
        return Inertia::render('Collaborator/Dashboard/Sales/Welcome');
    }
    public function sales_hab($id){
        $hotels = auth()->user()->hotel->load('orders.shippings');    
        $orders = Order::whereIn('hotel_id',$hotels->pluck('id'))->where("status", "complete")->with('hotel', 'shippings')->paginate(15); 
        return Inertia::render('Collaborator/Dashboard/Lodging/TotalSales', compact('hotels','orders'));
    }

    public function sales_hab_details($hab)
    {   
        $hotel = hotel::find($hab)->load('orders.shippings');
        return Inertia::render('Collaborator/Dashboard/Lodging/Details', compact('hotel'));
    }

    public function sales_property (Request $request) {
    	$hotels = auth()->user()->hotel->load('orders.shippings'); 
        $model = Order::whereIn('hotel_id',$hotels->pluck('id'))
                        ->where('type_order', '1')
                        ->where("status", "complete")
                        ->with('hotel', 'shippings')
                        ->Date($request->from, $request->to)
                        ->orderBy('id', 'desc')
                        ->paginate(8);
        $orders = $model->appends(request()->except('page'));

        $withdrawal = $orders->where("withdrawal",0);
        $date = null;
        if (!$withdrawal->isEmpty()) {
            $date = $withdrawal->last()->updated_at; 
        }

        return Inertia::render('Collaborator/Dashboard/Sales/During',compact('hotels','orders','date'));
    }

    public function sales_publicity (Request $request) {
        $hotels = auth()->user()->hotel->load('orders.shippings'); 
        $model = Order::whereIn('hotel_id',$hotels->pluck('id'))
                        ->where('type_order', '2')
                        ->where("status", "complete")
                        ->with('hotel', 'shippings')
                        ->Date($request->from, $request->to)
                        ->orderBy('id', 'desc')
                        ->paginate(8);
        $orders = $model->appends(request()->except('page'));

        $withdrawal = $orders->where("withdrawal",0);
        $date = null;
        if (!$withdrawal->isEmpty()) {
            $date = $withdrawal->last()->updated_at; 
        }

        return Inertia::render('Collaborator/Dashboard/Sales/Publicity',compact('orders'));
    }

    public function sales_total(Request $request){
        
        $hotels = auth()->user()->hotel->load('orders.shippings');
        $orders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)->paginate(15);
        $totalorders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)->get();
        $withdrawal = $orders->where("withdrawal",0);

        $date = null;

        if (!$withdrawal->isEmpty()) {
            $date = $withdrawal->first()->updated_at; 
        }

        return Inertia::render('Collaborator/Dashboard/Sales/Total',compact('hotels','orders','date','totalorders'));
    }
    public function notify(Request $request){

        $hotels = auth()->user()->hotel->load('orders.shippings');

        foreach ($hotels as $hotel) {
            $orders = Order::where('hotel_id',$hotel->id)->where("status","complete")->get();

            foreach ($orders as $order) {
                $updt = Order::find($order->id);
                $updt->withdrawal = 1;
                $updt->save();
            }
        }

        // return back();
        
    }
    public function withdrawal_history(Request $request){

        $hotels = auth()->user()->hotel->load('orders.shippings');
        $withdrawalsOrders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("withdrawal",0)
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)->paginate(15);
         
        $orders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("withdrawal",1)
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)->paginate(15);

        $date = null;

        if (!$withdrawalsOrders->isEmpty()) {
            $date = $withdrawalsOrders->first()->updated_at; 
        }
        return Inertia::render('Collaborator/Dashboard/Sales/Withdrawals',compact('hotels','orders','date','withdrawalsOrders'));
    }

    // end sales

    // Shipping

    public function create_shipping () {
        $collaboratorShippings = auth()->user()->collaboratorShippings;
        if ($collaboratorShippings->count() > 0) {
            $collaboratorShipping = $collaboratorShippings[0];
        } else {
            $collaboratorShipping = [
                'document' => '',
                'businessName' => '',
                'contactPerson' => '',
                'phone' => '',
                'email' => '',
                'deliveryAddress' => '',
                'province' => '',
                'city' => '',
            ];
        }
        return Inertia::render('Collaborator/Dashboard/Profile/Shipping', compact('collaboratorShipping'));
    }

    public function store_shipping(Request $request){
        $request->validate([
            'document' => 'required|string',
            'businessName' => 'required|string',
            'contactPerson' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'deliveryAddress' => 'required|string',
            'postalCode' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
        ]);
        $collaboratorShipping = CollaboratorShipping::where('user_id', auth()->user()->id)->first();
        if ($collaboratorShipping) {
            $collaboratorShipping->document = $request->document;
            $collaboratorShipping->businessName = $request->businessName;
            $collaboratorShipping->contactPerson = $request->contactPerson;
            $collaboratorShipping->phone = $request->phone;
            $collaboratorShipping->email = $request->email;
            $collaboratorShipping->deliveryAddress = $request->deliveryAddress;
            $collaboratorShipping->province = $request->province;
            $collaboratorShipping->city = $request->city;
            $collaboratorShipping->postalCode = $request->postalCode;
            $collaboratorShipping->save();
        } else {
            $collaboratorShipping = CollaboratorShipping::create([
                'user_id' => auth()->user()->id,
                'document' => $request->email,
                'businessName' => $request->businessName,
                'contactPerson' => $request->businessName,
                'phone' => $request->phone,
                'email' => $request->email,
                'deliveryAddress' => $request->deliveryAddress,
                'province' => $request->province,
                'postalCode' => $request->postalCode,
                'city' => $request->city,
            ]);
        }
        $id = mt_Rand(1000000, 9999999);
        return Redirect::route('collaborator.shipping.index')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);
    }

    // end shipping

    //bank

    public function create_bank () {
        $collaboratorBanks = auth()->user()->collaboratorBanks;
        if ($collaboratorBanks->count() > 0) {
            $collaboratorBank = $collaboratorBanks[0];
        } else {
            $collaboratorBank = [
                'holder' => '',
                'iban' => '',
            ];
        }
        return Inertia::render('Collaborator/Dashboard/Profile/Bank', compact('collaboratorBank'));
    }

    public function store_bank(Request $request){
        $request->validate([
            'holder' => 'required|string',
            'iban' => 'required|string',
        ]);
        $collaboratorBank = CollaboratorBank::where('user_id', auth()->user()->id)->first();
        if ($collaboratorBank) {
            $collaboratorBank->holder = $request->holder;
            $collaboratorBank->iban = $request->iban;
            $collaboratorBank->save();
        } else {
            $collaboratorBank = CollaboratorBank::create([
                'user_id' => auth()->user()->id,
                'holder' => $request->holder,
                'iban' => $request->iban,
            ]);
        }

        $id = mt_Rand(1000000, 9999999);
        return Redirect::route('collaborator.bank.index')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);
    }

    public function index_antes () {
        return Inertia::render('Collaborator/Dashboard/Resource/BeforeArrival');
    }

    public function banner (Request $request) {
        $city = $request->city ?? null;
        $width = $request->width ?? null;
        $url = [
            'path' => null,
            'fullPath' => null,
        ];
        if ($city && $width) {
            if ($city == 'sevilla' && $width == '160x600') {
                $url['path'] = 'vendor_asset/img/collaborator/dashboard/BANNERS/160x600.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
            if ($city == 'sevilla' && $width == '200x700') {
                $url['path'] = 'vendor_asset/img/collaborator/dashboard/BANNERS/200x700.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
            if ($city == 'sevilla' && $width == '728x90') {
                $url['path'] =  'vendor_asset/img/collaborator/dashboard/BANNERS/728x90.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
        }
        return Inertia::render('Collaborator/Dashboard/Resource/BeforeArrivalBanner', compact('url'));
    }

    public function url (Request $request) {
        $city = $request->city ?? null;
        $url = null;
        if ($city) {
            $idUser = auth::user()->id;
            $url = url('?p='.$city.'&c='.$idUser.'&t=2');
        }
        return Inertia::render('Collaborator/Dashboard/Resource/BeforeArrivalUrl', compact('url'));
    }
}
