<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use App\Models\User;
use App\Models\profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Redirect;
use Image;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Dashboard/Hotels',['hotels' => hotel::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Dashboard/Create/Hotel');
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
            'gender'            => 'required|string', 'in:H,M',
            'name'              => 'required|string',
            'email'             => 'required|string|email|max:255|unique:users',
            'type'              => 'required|string', 'in:apartament,hotel',
            'address'           => 'required|string',
            'zone'              => 'required|string',
        ]);

        $featured = $request->featured;
        $msg =$this->valid($featured);
        if ($msg['code']=='404')   return back()->with(['id'=>$msg['id'], 'message' => $msg['msg'], 'code' => $msg['code'], 'status' => 'error']);

        try {
            $id = mt_Rand(1000000, 9999999);
            $password = Str::lower(Str::random(8));
            
            $user = User::create([
                'name' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            $userProfile = $user->profile()->create([
                'firstname'  => $request->firstname,
                'lastname'   => $request->lastname,
                'gender'     => $request->gender,
            ]);

            $Path = public_path('storage/hotel/');
            $pathName = '/';

            if (!file_exists($Path)) {
                mkdir($Path, 777, true);
            }

            $nameFile =$this->FileName($featured); //nombre de archivo original
            $imgFileOriginal = Image::make($featured->getRealPath());
            $imgFileOriginal->save($Path.$nameFile['fileName']);

            $hotel = hotel::create([
                'name'       => $request->name,
                'type'       => $request->type,
                'address'    => $request->address,
                'zone'       => $request->zone,
                'image'      => $pathName.$nameFile['fileName'],
            ]);
            $clientUser = User::create([
                'name' => $request->email,
                'email' => $request->email.$user->id,
                'password' => Hash::make($password),
            ]);

            $user->assignRole('Hotel');
            $user->hotel()->attach($hotel->id, ['manager' => true]);
            
            $clientUser->assignRole('Client');
            $clientUser->hotel()->attach($hotel->id, ['manager' => false]);

            Mail::to($user->email)->send(new WelcomeReceived($user, $password));
        return Redirect::route('hotels.index')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
        } catch (Exception $e) {
            
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(hotel $hotel)
    {
        $hotel= hotel::with([
                    'user' => function ($query) {
                        $query->where('hotel_user.manager', 1);
                    },'user.profile'
                ])
                ->where('id', $hotel->id)
                ->first();

        return Inertia::render('Dashboard/Show/Hotel',compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(hotel $hotel)
    {
        $hotel= hotel::with([
                    'user' => function ($query) {
                        $query->where('hotel_user.manager', 1);
                    },'user.profile'
                ])
                ->where('id', $hotel->id)
                ->first();
        return Inertia::render('Dashboard/Edit/Hotel',compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hotel $hotel)
    {

         $id = mt_Rand(1000000, 9999999);  
            /*actualizo usuario*/
            $user=User::find($request->user_id);
            $user->name = $request->firstname." ".$request->lastname ;
            $user->email = $request->email;
            $user->save();

         if ($request->featured) {
            $featured = $request->featured;
            $msg =$this->valid($featured);
            if ($msg['code']=='404')   return back()->with(['id'=>$msg['id'], 'message' => $msg['msg'], 'code' => $msg['code'], 'status' => 'error']);

            $Path = public_path('storage/hotel/');
            $pathName = '/';

            if (!file_exists($Path)) {
                mkdir($Path, 777, true);
            }

            $nameFile =$this->FileName($featured); //nombre de archivo original
            $imgFileOriginal = Image::make($featured->getRealPath());
            $imgFileOriginal->save($Path.$nameFile['fileName']);

        }

       

        $profile=profile::find($user->profile->id);
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->gender = $request->gender;
        $profile->save();

        /*actualizo hotel*/
        $hotel = hotel::find($request->hotel);
        $hotel->name = $request->name;
        $hotel->type = $request->type;
        $hotel->address = $request->address;
        $hotel->zone = $request->zone;
        if ($request->featured) {
            $hotel->image = $pathName.$nameFile['fileName'];
        }
        $hotel->zone = $request->zone;
        $hotel->save();
       
        return Redirect::route('hotels.index')->with(['id'=>$id, 'message' => 'Update Success', 'code' => 200, 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(hotel $hotel)
    {
        $id = mt_Rand(1000000, 9999999); 
        
        foreach ($hotel->user as $user) {
            $user=User::find($user->id)->delete();
        }
        $hotel->delete();
     return back()->with(['id'=>$id, 'message' => 'Eliminado con exito', 'code' => 200, 'status' => 'success']);   
    }
}
