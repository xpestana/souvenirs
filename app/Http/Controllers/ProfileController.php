<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\User;
use App\Models\hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Redirect;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //    dd(auth()->user()->getRoleNames()->first());
        /*Redirección si no tiene perfil*/
        if (auth()->user()->profile == null && auth()->user()->getRoleNames()->first() != 'Client') {
            return Redirect::route('collaborator.data');
        }
        /*******************************/
        if (auth()->user()->getRoleNames()->first() == 'Hotel') {
            return Redirect::route('collaborator.dashboard.home');
        }
        if (auth()->user()->getRoleNames()->first() == 'Associate') {
            return Redirect::route('associates.home');
        }
        if (auth()->user()->getRoleNames()->first() == 'Admin') {
            return Redirect::route('admin.colaboradores');
        }
        if (auth()->user()->getRoleNames()->first() == 'Client') {
            Auth::logout();

            return Redirect::route('login');
        }
        if (auth()->user()->getRoleNames()->first() == 'Hotel') {
            $hotel = hotel::find(auth()->user()->hotel->first()->id);
            $url = config('app.url');
            $client = $hotel->user()->wherePivot('manager', false)->first();
        }else{
            $hotel = null;
            $url = null;
            $client = null;
        }
        
        return Inertia::render('Dashboard/Profile', compact('url', 'client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $profile)
    {
        
        $id = mt_Rand(1000000, 9999999);
        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }
            
        $profile = profile::find($profile);
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->gender = $request->gender;
        $profile->save();

        $profile->user()->update([
                    'name' => $request->firstname." ".$request->lastname,
                    'email' => $request->email,
                ]);
        if ($request->password) {
            $profile->user()->update([
                    'password' => Hash::make($request->password),
                ]);  
        }
        return back()->with(['id'=>$id, 'message' => 'Actualizado correctamente', 'code' => 200, 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile $profile)
    {
        //
    }
}
