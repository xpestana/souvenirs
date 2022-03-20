<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use App\Models\hotel;
use App\Models\User;
use App\Models\profile;
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
    public function index()
    {
        /*Redirección si no tiene perfil*/
        if (auth()->user()->profile == null) {
            return Redirect::route('collaborator.data');
        }
        /*******************************/
        
        $hotels = auth()->user()->hotel;
        $url = env('APP_URL');
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
            'gestor' => ['required','string', Rule::in([1, 2])],
            'razon' => 'required|string',
            'nif' => 'required|string',
            'id' => 'required|string',
            'city' => 'required|string',
            'cp' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = profile::create([
            'user_id' => auth()->user()->id,
            'firstname' => $request->name,
            'phone' => $request->phone,
            'gestor' => $request->gestor,
            'razon' => $request->razon,
            'nif' => $request->nif,
            'identify' => $request->identify,
            'city' => $request->city,
            'cp' => $request->cp,
            'address' => $request->address,
        ]);
        auth()->user()->assignRole('Hotel');

        return Redirect::route('collaborator.index')->with(['id'=>auth()->user()->id, 'message' => 'Registro exitoso', 'code' => 200, 'status' => 'success']);
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
                'calle'       => $request->calle,
                'type'        => (auth()->user()->profile->gestor == 1) ? "hotel" : "apartamento",
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

        $hotel = hotel::find($id);
        return Inertia::render('Collaborator/Dashboard/Lodging/Edit',compact('hotel'));
    }

    public function update_hab($id,Request $request){
        
        $request->validate([
            'calle' => 'required|string',
            'planta' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'cp' => 'required|string',
            'code' => 'nullable|string'
        ]);

        // try{
            
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

            return Redirect::route('collaborator.index')->with(['id'=>$id, 'message' => 'Alojamiento actualizado exitosamente!', 'code' => 200, 'status' => 'success']);  
        // }catch (Exception $e) 
        // {
        
        // }

        

    }

    public function sales_hab_details($id)
    {   
        $hotel = hotel::find($id);
        return Inertia::render('Collaborator/Dashboard/Lodging/Details', compact('hotel'));
    }
}
