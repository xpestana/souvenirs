<?php

namespace App\Http\Controllers\Collaborator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\profile;
use Inertia\Inertia;
use Redirect;

class ProfileCollaboratorController extends Controller
{
    public function index()
    {
        return Inertia::render('Collaborator/Dashboard/Settings');
    }
    public function profile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'password' => ['nullable', 
                Rules\Password::min(8)
                ->mixedCase()
                ->numbers()
                ->uncompromised()
            ],
        ]);
        $id = mt_Rand(1000000, 9999999);
        $user = User::find(auth()->user()->id);
        $user->email = $request->email;
        if($request->password != null){
            $user->password = Hash::make($request->password);    
        }
        $user->save();

        $profile = profile::find(auth()->user()->profile->id);
        $profile->firstname = $request->name;
        $profile->phone = $request->phone;
        $profile->save();
        return back()->with(['id'=>$id, 'message' => 'Updated successfully', 'code' => 200, 'status' => 'success']);
    }
    public function fiscal(Request $request)
    {
        $id = mt_Rand(1000000, 9999999);

        $request->validate([
            'razon' => 'required|string',
            'nif' => 'required|string',
            'identifier' => 'required|string',
            'city' => 'required|string',
            'cp' => 'required|string',
            'address' => 'required|string',
        ]);
        $profile = profile::find(auth()->user()->profile->id);
        $profile->razon = $request->razon;
        $profile->nif = $request->nif;
        $profile->identify = $request->identifier;
        $profile->city = $request->city;
        $profile->cp = $request->cp;
        $profile->address = $request->address;
        $profile->save();

        return back()->with(['id'=>$id, 'message' => 'Updated successfully', 'code' => 200, 'status' => 'success']);
    }
}
