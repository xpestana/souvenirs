<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use App\Models\User;
use App\Models\profile;
use App\Models\Settings;
use App\Models\Products;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Redirect;
use Image;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role('Admin')->with('profile')->paginate(10);
        return Inertia::render('Dashboard/Admins', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Admins/Create');
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
            'firstname'         => 'required|string',
            'lastname'          => 'required|string',
            'email'             => 'required|string|email|max:255|unique:users|confirmed',
            'password'          => 
            ['required', 'confirmed', 
                Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->uncompromised()
            ],
        ]);
        $id = mt_Rand(1000000, 9999999);

        try {
             $user = User::create([
                'name' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        $user->assignRole('Admin');
        $userProfile = $user->profile()->create([
                'firstname'  => $request->firstname,
                'lastname'   => $request->lastname,
            ]); 
        } catch (Exception $e) {
            dd($e);
        }
        Mail::to($user->email)->send(new WelcomeReceived($user, $request->password));
    return Redirect::route('admin.administradores')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
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
        $user = User::find($id)->load('profile');
        return Inertia::render('Admin/Admins/Update', compact('user'));
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
            'firstname'         => 'required|string',
            'lastname'          => 'required|string',
            'email'             => ['nullable', 'email', 'confirmed', 'max:255', Rule::unique('users')->ignore($id)],
            'password'          => 
            ['nullable', 'confirmed', 
                Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->uncompromised()
            ],
        ]);
        $ran = mt_Rand(1000000, 9999999);
        //dd($request->email);
             $user = User::find($id);
             $user->email = $request->email;

             if ($request->password != null) {
                 $user->password = Hash::make($request->password);
             }
             $user->save();

        $user->assignRole('Admin');

        $profile = profile::find($user->profile->id);
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->save();
        
        return Redirect::route('admin.administradores')->with(['id'=>$ran, 'message' => 'Actualizado exitosamente', 'code' => 200, 'status' => 'success']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id)->delete();
        return back()->with(['id'=>$id, 'message' => 'Eliminado con exito', 'code' => 200, 'status' => 'success']); 
    }

    /*Admin nuevo*/


    public function home()
    {
        return Inertia::render('Admin/index');
    }

    public function colaboradores(Request $request)
    {
        $collaborators = User::join('profiles', 'profiles.user_id', '=', 'users.id')
                ->select('users.*', 'profiles.firstname','profiles.lastname')
                ->role('Hotel')
                ->search($request->search)
                ->email($request->search, 'Hotel')
                ->with('hotel.orders.shippings')
                ->orderBy('profiles.firstname','ASC')
                ->paginate(10);
        return Inertia::render('Admin/Collaborators',compact('collaborators'));
    }
    public function collaborator_create(){
        return Inertia::render('Admin/Collaborators/Create');
    }
    public function collaborator_edit($id){
        $user = User::find($id)->load('profile');
        return Inertia::render('Admin/Collaborators/Edit', compact('user'));
    }
    
    public function collaborator_updt(Request $request, $id){
        $request->validate([
            'email' => ['nullable', 'email', 'confirmed', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => 
            ['nullable', 
                Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->uncompromised()
            ],
            'name' => 'required|string',
            'phone' => 'required|string',
            'gestor' => ['required','string', Rule::in([1, 2])],
            'razon' => 'required|string',
            'nif' => 'required|string',
            'id' => 'required|string',
            'city' => 'required|string',
            'cp' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = User::find($id);
        $user->name = $request->email;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        
        $profile = profile::find($user->profile->id);
        $profile->firstname = $request->name;
        $profile->phone = $request->phone;
        $profile->gestor = $request->gestor;
        $profile->razon = $request->razon;
        $profile->nif = $request->nif;
        $profile->identify = $request->id;
        $profile->city = $request->city;
        $profile->cp = $request->cp;
        $profile->address = $request->address;
        $profile->save();

        return back()->with(['id'=>$user->id, 'message' => "Actualizacion exitosa", 'code' => 200, 'status' => 'success']);
    }
    public function collaborator_delete($id){

        $user = User::find($id)->delete();
        $id = mt_Rand(1000000, 9999999);

        return Redirect::route('admin.colaboradores')->with(['id'=>$id, 'message' => "Eliminado exitosamente", 'code' => 200, 'status' => 'success']);
    }
    public function collaborator_store(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users|confirmed',
            'password' => 
            ['required', 
                Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->uncompromised()
            ],
            'name' => 'required|string',
            'phone' => 'required|string',
            'gestor' => ['required','string', Rule::in([1, 2])],
            'razon' => 'required|string',
            'nif' => 'required|string',
            'id' => 'required|string',
            'city' => 'required|string',
            'cp' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $userProfile = profile::create([
            'user_id' => $user->id,
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

        $user->assignRole('Hotel');

        Mail::to($user->email)->send(new WelcomeReceived($user, $request->password));

         return back()->with(['id'=>$user->id, 'message' => "Registro exitoso", 'code' => 200, 'status' => 'success']);
    }

    public function collaborator_details($id)
    {
        $collaborator = User::find($id)->load('profile','hotel.orders.shippings');
        $url = config('app.url');
        return Inertia::render('Admin/Collaborators/Show',compact('collaborator','url'));
    }
    public function lodging_create($id){
        $collaborator = User::find($id)->load('profile','hotel.orders.shippings');
        return Inertia::render('Admin/Collaborators/Lodging/Create', compact('collaborator'));
    }
    public function lodging_store(Request $request){
        $request->validate([
            'collaborator' => 'required',
            'calle' => 'required|string',
            'planta' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'cp' => 'required|string',
            'code' => 'nullable|string',
            'url' => 'nullable|url',
            'area' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,jpg,png',
        ]);

            $id = mt_Rand(1000000, 9999999);
            $image = $request->image;
            $user = User::find($request->collaborator);
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
                'calle'       => $request->calle,
                'type'        => ($user->profile->gestor == 1) ? "hotel" : "apartamento",
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

        return Redirect::route('admin.collaborator.show',["id" => $request->collaborator])->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
    }
    public function collaborator_lodging_edit($id,$idCol){
        $collaborator = User::find($idCol)->load('profile','hotel.orders.shippings');
        $lodging = Hotel::find($id);
        return Inertia::render('Admin/Collaborators/Lodging/Edit',compact('lodging','collaborator'));
    }

    public function collaborator_lodging_update(Request $request, $id){
        $request->validate([
            'calle' => 'required|string',
            'planta' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'cp' => 'required|string',
            'code' => 'nullable|string'
        ]);

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

            // return back()->with(['id'=>$id, 'message' => 'Alojamiento actualizado exitosamente!', 'code' => 200, 'status' => 'success']);  
            return Redirect::route('admin.collaborator.show',$request->idCol)->with(['id'=>$id, 'message' => 'Alojamiento actualizado exitosamente!', 'code' => 200, 'status' => 'success']); 
    }
    public function lodging_delete($hotel, $collaborator){

        $user = hotel::find($hotel)->delete();
        $id = mt_Rand(1000000, 9999999);

        return Redirect::route('admin.collaborator.show', ['id' => $collaborator])->with(['id'=>$id, 'message' => "Eliminado exitosamente", 'code' => 200, 'status' => 'success']);
    }
    public function admins(Request $request)
    {
        $admins = User::join('profiles', 'users.id', '=', 'profiles.user_id')
                ->role('Admin')
                ->search($request->search)
                ->email($request->search, 'Admin')
                ->orderBy('profiles.firstname','ASC')
                ->paginate(10);
        return Inertia::render('Admin/Admin',compact('admins'));
    }
    public function administrator_create(Request $request)
    {
        return Inertia::render('Admin/Admins/Create');
    }
    public function administrator_store(Request $request)
    {
        return back();
    }
    public function administrator_details(Request $request)
    {
        return Inertia::render('Admin/Admins/Update');
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

    public function souvenirs(Request $request)
    {
        $products = Products::where('type', 'Souvenirs')
                            ->search($request->search)
                            ->orderBy('title','ASC');
                            
        if(!empty($request->search))
        {
            $products = $products->where('del', 0)->get();
        }
        else{
            $products = $products->where('del', 0)->paginate(8);
        }
                            
                           // dd($products);
        $settings = Settings::all();
        return Inertia::render('Admin/Souvenirs', compact('settings','products'));
    }

    public function souvenirs_create(Request $request)
    {
        return Inertia::render('Admin/Souvenirs/Create');
    }

    public function souvenirs_edit(Request $request,$id,$numPage)
    {
        $product = Products::with('images')->where('id', $id)->first();

        return Inertia::render('Admin/Souvenirs/Edit', compact('product','numPage'));
    }

    public function shippings_create(Request $request)
    {
        $request->validate([
            'shippings' => 'required|numeric',
        ]);
        $settings = Settings::where('active',1)->first();
        if($settings){
            $settings->active = 0;
            $settings->save();
        }
        $settings = Settings::create([
            'shippings' => $request->shippings,
        ]);

        return back()->with(['id'=>$settings->id, 'message' => "Valor creado exitosamente", 'code' => 200, 'status' => 'success']);
    }
    public function shippings_update($id, Request $request)
    {
        $settings = Settings::where('active',1)->first();
        if($settings){
            $settings->active = 0;
            $settings->save();
        }
        $settings = Settings::find($id);
        $settings->active = 1;
        $settings->save();

        return back()->with(['id'=>$settings->id, 'message' => "Actualizado exitosamente", 'code' => 200, 'status' => 'success']);
    }

    public function sales_hab_details($hab,$id)
    {   
        $collaborator = User::find($id)->load('profile','hotel.orders.shippings');
        $hotel = hotel::find($hab)->load('orders.shippings');
        return Inertia::render('Admin/Collaborators/Lodging/Details', compact('hotel','collaborator'));
    }

    public function sales_hab($id){
        $orders = Order::join('hotels', 'hotels.id', '=', 'orders.hotel_id')
                ->join('hotel_user', 'hotels.id', '=', 'hotel_user.hotel_id')
                ->select('orders.*', 'hotels.type', 'hotels.address', 'hotels.zone', 'hotels.calle', 'hotels.image', 'hotels.planta')
                ->where('hotel_user.user_id', $id)
                ->orderBy('orders.created_at','DESC')
                ->paginate(10);
        $orders->load('shippings');
        $collaborator = User::find($id)->load('profile','hotel.orders.shippings');       
        return Inertia::render('Admin/Collaborators/Lodging/TotalSales', compact('collaborator','orders'));
    }
}
