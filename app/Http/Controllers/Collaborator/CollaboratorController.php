<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Mail\SaleSouvenirReceived;
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
use App\Mail\WelcomeReceived;
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
        $cont = step();
        
        return Inertia::render('Collaborator/Dashboard/Home', compact('cont'));
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
    public function index()
    {
        /*Redirección si no tiene perfil*/
        if (auth()->user()->profile == null) {
            return Redirect::route('collaborator.data');
        }
        /*******************************/
        
        $hotels = auth()->user()->hotel->load('orders.shippings');
        $url = config('app.url');
        
        return Inertia::render('Collaborator/Dashboard/Index', compact('hotels','url'));
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
            return Redirect::route('collaborator.index')->with(['id'=>auth()->user()->id, 'message' => 'Registro exitoso', 'code' => 200, 'status' => 'success']);
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
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'cp' => 'required|string',
                'code' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
            ]);
        }else{
            $request->validate([
                'calle' => 'required|string',
                'planta' => 'required|string',
                'address' => 'nullable|string',
                'city' => 'required|string',
                'cp' => 'required|string',
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
                $nameFile =$this->FileName($image); //nombre de archivo original
                $imgFileOriginal = Image::make($image->getRealPath());
                $imgFileOriginal->save($Path.$nameFile['fileName']);
                $name_file = $nameFile['fileName'];
            }else{
                $name_file ="default.jpg";
            }
            $hotel = hotel::create([
                'name'        => ($request->nombre_hotel) ? $request->nombre_hotel : null,
                'hab'         => ($request->numero_habitaciones) ? $request->numero_habitaciones : null,
                'calle'       => $request->calle,
                'type'        => $request->tipo,
                'address'     => $request->address,
                'zone'        => $request->city,
                'planta'      => $request->planta,
                'cp'          => $request->cp,
                'code'        => $request->code,
                'url'         => $request->url,
                'area'        => $request->area,
                'image'       => $pathName.$name_file,
            ]);

            $clientUser = User::create([
                'name' => auth()->user()->email,
                'email' => auth()->user()->email.$hotel->id,
                'password' => Hash::make("usuario123456"),
            ]);
            
            $user->hotel()->attach($hotel->id, ['manager' => true]);
            
            $clientUser->assignRole('Client');
            $clientUser->hotel()->attach($hotel->id, ['manager' => false]);

        return Redirect::route('collaborator.index')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
        } catch (Exception $e) {
            
        }
    }

    public function edit_hab($id){

        $hotel = hotel::find($id)->load('orders.shippings');
        $url = config('app.url');
        return Inertia::render('Collaborator/Dashboard/Lodging/Edit',compact('hotel','url'));
    }

    public function update_hab($id,Request $request){
            
        if($request->type == 'hotel'){
            $request->validate([
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'cp' => 'required|string',
                'code' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
            ]);
        }else{
            $request->validate([
            'calle' => 'required|string',
            'planta' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'cp' => 'required|string',
            'code' => 'nullable|string'
            ]);
        }

         try{
            
         if ($request->image) {
            $image = $request->image;
            $msg =$this->valid($image);
            if ($msg['code']=='404')   return back()->with(['id'=>$msg['id'], 'message' => $msg['msg'], 'code' => $msg['code'], 'status' => 'error']);

            $Path = public_path('storage/hotel/');
            $pathName = '/';

            if (!file_exists($Path)) {
                mkdir($Path, 777, true);
            }

            $nameFile =$this->FileName($image); //nombre de archivo original
            $imgFileOriginal = Image::make($image->getRealPath());
            $imgFileOriginal->save($Path.$nameFile['fileName']);

            }

            $hotel = hotel::find($id);
            $hotel->name = ($request->nombre_hotel) ? $request->nombre_hotel : null;
            $hotel->hab  = ($request->numero_habitaciones) ? $request->numero_habitaciones : null;
            $hotel->calle = $request->calle;
            $hotel->address = $request->address;
            $hotel->zone = $request->city;
            $hotel->planta = $request->planta;
            $hotel->cp = $request->cp;
            $hotel->code = $request->code;
            $hotel->url = $request->url;
            $hotel->area = $request->area;            
            if ($request->image) {
                $hotel->image = $pathName.$nameFile['fileName'];
            }
            $hotel->save();

            return Redirect::route('collaborator.index')->with(['id'=>$id, 'message' => 'Alojamiento actualizado exitosamente!', 'code' => 200, 'status' => 'success']);  
         }catch (Exception $e) 
         {
        
         }
    }

    public function sales(){
        $hotels = auth()->user()->hotel->load('orders.shippings');    
        $orders = Order::whereIn('hotel_id',$hotels->pluck('id'))->where("status", "complete")->with('hotel', 'shippings')->paginate(15);   
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

}
