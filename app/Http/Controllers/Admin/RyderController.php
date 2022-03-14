<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeReceived;
use App\Models\User;
use Inertia\Inertia;
use Redirect;

class RyderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role('Ryder')->with('profile.ryder')->paginate(10);

        return Inertia::render('Dashboard/Ryders', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Dashboard/Create/Ryders');
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
            'address'          => 'required|string',
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
        $user->assignRole('Ryder');
        $userProfile = $user->profile()->create([
                'firstname'  => $request->firstname,
                'lastname'   => $request->lastname,
                'gender'     => $request->gender,
            ]);
        $userProfile->ryder()->create([
                'address'  => $request->address,
            ]);
        Mail::to($user->email)->send(new WelcomeReceived($user, $password));
        } catch (Exception $e) {
            dd($e);
        }
        
            return Redirect::route('ryders.index')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
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
        $user= User::Find($id);
        $user->load('profile.ryder');

        return Inertia::render('Dashboard/Edit/Ryder', compact('user'));
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
            'address'          => 'required|string',
            'gender'            => 'required|string', 'in:H,M',
        ]);

        $user = User::find($id);
        $user->email = $request->email;
        $user->save();

        $profile = $user->profile()
                            ->update([
                                'firstname' => $request->firstname,
                                'lastname' => $request->lastname,
                                'gender' => $request->gender,
                            ]);
        $ryder = $user->profile->ryder()
                            ->update([
                                'address' => $request->address,
                            ]);

        $id = mt_Rand(1000000, 9999999);

        return Redirect::route('ryders.index')->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']);  
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
}
