<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use App\Models\User;
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
        return Inertia::render('Dashboard/Hotels',['hotels' => hotel::all()]);
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
            $password = Str::random(8);
            
            $user = User::create([
                'name' => $request->email,
                'email' => $request->email,
                'password' => Hash::make(Str::lower($password)),
            ]);

            $userProfile = $user->profile()->create([
                'firstname'  => $request->firstname,
                'lastname'   => $request->lastname,
                'gender'     => $request->gender,
            ]);

            $Path = public_path('storage/hotel/'.$user->id.'/');
            $pathName = $user->id.'/';

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

            $user->assignRole('Hotel');
            $user->hotel()->attach($hotel->id, ['manager' => true]);

            //Mail::to($user->email)->send(new WelcomeReceived($user, $password));
        return back()->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(hotel $hotel)
    {
        $hotel = $hotel->load('user');
        return Inertia::render('Pruebas/Edit_hotel',compact('hotel'));
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
         $validator = $this->validate($request, [
            'name'              => 'required|string',
            'email'             => 'required|string|email|max:255',
            'type'              => 'required|string', 'in:apartament,hotel',
            'address'           => 'required|string',
            'zone'              => 'required|string',
        ]);
         $id = mt_Rand(1000000, 9999999);  
         /*actualizo usuario*/
        $user=User::find($hotel->user_id);
         $user->name = $request->name;
         $user->email = $request->email;
         $user->save();

         /*actualizo hotel*/
         $hotel->type = $request->type;
         $hotel->address = $request->address;
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
        $user=User::find($hotel->user_id)->delete();
        $hotel->delete();
     return Redirect::route('hotels.index')->with(['id'=>$id, 'message' => 'Update Success', 'code' => 200, 'status' => 'success']);   
    }
}
