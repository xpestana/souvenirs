<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use App\Models\User;
use App\Models\profile;
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
        return Inertia::render('Dashboard/Create/Admin');
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
            'email'             => 'required|string|email|max:255|unique:users',
        ]);
        $id = mt_Rand(1000000, 9999999);
        $password = Str::lower(Str::random(8));
        try {
             $user = User::create([
                'name' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);
        $user->assignRole('Admin');
        $userProfile = $user->profile()->create([
                'firstname'  => $request->firstname,
                'lastname'   => $request->lastname,
                'gender'     => $request->gender,
            ]); 
        } catch (Exception $e) {
            dd($e);
        }
       
        Mail::to($user->email)->send(new WelcomeReceived($user, $password));
            return Redirect::route('admin.index')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
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
        //
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
        //
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

    public function colaboradores()
    {
        $collaborators = User::role('Hotel')->with('profile','hotel.orders.shippings')->paginate(10);
        return Inertia::render('Admin/Collaborators',compact('collaborators'));
    }
    public function collaborator_create(){
        return Inertia::render('Admin/Collaborators/Create');
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

        $user->assignRole('Hotel');

        Mail::to($user->email)->send(new WelcomeReceived($user, $request->password));

         return back()->with(['id'=>$user->id, 'message' => "Registro exitoso", 'code' => 200, 'status' => 'success']);
    }

    public function collaborator_details($id)
    {
        $collaborator = User::find($id)->load('profile','hotel.orders.shippings');
        return Inertia::render('Admin/Collaborators/Show',compact('collaborator'));
    }

    public function collaborator_lodging_edit(){
        return 'Editar alojamiento';
    }
}
