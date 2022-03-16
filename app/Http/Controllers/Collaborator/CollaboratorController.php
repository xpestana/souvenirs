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
        
        return Inertia::render('Collaborator/Dashboard/Index');
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
            'password' => ['required', Rules\Password::defaults()],
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

        return Redirect::route('collaborator.index')->with(['id'=>auth()->user()->id, 'message' => 'Registro exitoso', 'code' => 200, 'status' => 'success']);
    }
}
