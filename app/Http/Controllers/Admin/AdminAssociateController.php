<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\hotel;
use App\Models\User;
use App\Models\profile;
use App\Models\Settings;
use App\Models\Shipping;
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
use Illuminate\Support\Facades\Redirect;
use App\Models\CollaboratorBank;
use App\Models\CollaboratorShipping;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Image;



class AdminAssociateController extends Controller {

    public function associates(Request $request)
    {
        $collaborators = User::join('profiles', 'profiles.user_id', '=', 'users.id')
                ->select('users.*', 'profiles.firstname','profiles.lastname','profiles.city')
                ->role('Associate')
                ->search($request->search)
                ->email($request->search, 'Associate')
                ->where('del',false)
                ->with('orders.shippings')
                ->orderBy('profiles.firstname','ASC')
                ->paginate(4);
        $url = config('app.url');
        foreach ($collaborators->items() as $key => $user) {
            //Valid information perfil
            $validInformation = !empty($user->profile->firstname) && !empty($user->email) && !empty($user->profile->phone);
            $collaborators->items()[$key]['completInformation'] = $validInformation;

            //Valid information nif
            $validNif = !empty($user->profile->identify) && !empty($user->profile->nif) && !empty($user->profile->address) && !empty($user->profile->city);
            $collaborators->items()[$key]['completedNif'] = $validNif;

            //Valid information shipping
            $validShipping = !$user->collaboratorShippings->isEmpty();
            $collaborators->items()[$key]['completedShipping'] = $validShipping;

            //Valid information banck
            $validBank = !$user->collaboratorBanks->isEmpty();
            $collaborators->items()[$key]['completedBank'] = $validBank;

            //Valid banner
            $validBanner = $user->resources()->where('name', 'banner')->first();
            $collaborators->items()[$key]['completedBanner'] = !empty($validBanner);

            //Valid url
            $validUrl = $user->resources()->where('name', 'url')->first();
            $collaborators->items()[$key]['completedUrl'] = !empty($validUrl);

            //Valid request-display
            $validRequestDisplay = $user->resources()->where('name', 'request-display')->first();
            $collaborators->items()[$key]['completedRequestDisplay'] = !empty($validRequestDisplay);

            //Valid received-display
            $validReseivedDisplay = $user->resources()->where('name', 'received-display')->first();
            $collaborators->items()[$key]['completedReseivedDisplay'] = !empty($validReseivedDisplay);
        }
        return Inertia::render('Admin/Associates/Index',compact('collaborators','url') );
    }

    public function store (Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'contraseña' => ['required', Rules\Password::defaults()],
            'contacto' => 'required|string',
        ]);

        $id = mt_Rand(1000000, 9999999);

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->contraseña),
        ]);

        $user->profile()->create([
            'firstname' => $request->nombre,
            'phone' => $request->contacto,
            'gestor' => '2',
        ]);

        $user->assignRole('Associate');

        return back()->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']); 
    }

    public function associate_profile(User $user)
    {
        $user->load('profile');
        return Inertia::render('Admin/Associates/Profile/Info',compact('user'));   
    }

    public function update_profile(Request $request, $profile)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $id = mt_Rand(1000000, 9999999);
        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }
            
        $profile = profile::find($profile);
        $profile->firstname = $request->name;
        $profile->phone = $request->phone;
        $profile->save();

        $profile->user()->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
        if ($request->password) {
            $profile->user()->update([
                    'password' => Hash::make($request->password),
                ]);  
        }
        return Redirect::route('admin.associates')->with(['id'=>$id, 'message' => 'Datos actualizados correctamente', 'code' => 200, 'status' => 'success']);
    }

    public function associate_tax(User $user)
    {
        $user->load('profile');
        return Inertia::render('Admin/Associates/Profile/Tax',compact('user'));   
    }

    public function update_tax(Request $request)
    {
        $id = mt_Rand(1000000, 9999999);

        $request->validate([
            'nif' => 'required|string',
            'razon' => 'required|string',
            'phone' => 'required|numeric',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($request->user_id)],
            'address' => 'required|string',
            'identifier' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'cp' => 'required|string',
        ]);

        $user = User::find($request->user_id);
        $user->email = $request->email;
        $user->save();

        $profile = profile::find($request->profile_id);
        $profile->firstname = $request->name;
        $profile->phone = $request->phone;
        $profile->razon = $request->razon;
        $profile->nif = $request->nif;
        $profile->identify = $request->identifier;
        $profile->city = $request->city;
        $profile->province = $request->province;
        $profile->cp = $request->cp;
        $profile->address = $request->address;
        $profile->save();

        return Redirect::route('admin.associates')->with(['id'=>$id, 'message' => 'Datos actualizados correctamente', 'code' => 200, 'status' => 'success']);
    }
    public function associate_bank(User $user)
    {
        $collaboratorBanks = User::findOrFail($user->id)->collaboratorBanks;
        if ($collaboratorBanks->count() > 0) {
            $collaboratorBank = $collaboratorBanks[0];
        } else {
            $collaboratorBank = [
                'holder' => '',
                'iban' => '',
            ];
        }
        $user->load('profile');
        return Inertia::render('Admin/Associates/Profile/Bank',compact('collaboratorBank','user'));   
    }

    public function update_bank(Request $request){
        $request->validate([
            'holder' => 'required|string',
            'iban' => 'required|string',
        ]);
        $collaboratorBank = CollaboratorBank::where('user_id', $request->user_id)->first();
        if ($collaboratorBank) {
            $collaboratorBank->holder = $request->holder;
            $collaboratorBank->iban = $request->iban;
            $collaboratorBank->save();
        } else {
            $collaboratorBank = CollaboratorBank::create([
                'user_id' => $request->user_id,
                'holder' => $request->holder,
                'iban' => $request->iban,
            ]);
        }

        $id = mt_Rand(1000000, 9999999);
        return Redirect::route('admin.associates')->with(['id'=>$id, 'message' => 'Datos actualizados correctamente', 'code' => 200, 'status' => 'success']);
    }
    public function associate_shipping(User $user)
    {
        $collaboratorShippings = User::findOrFail($user->id)->collaboratorShippings;
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
        $user->load('profile');
        return Inertia::render('Admin/Associates/Profile/Shipping', compact('collaboratorShipping','user'));      
    }

    public function update_shipping(Request $request){
        $request->validate([
            'document' => 'required|string',
            'businessName' => 'required|string',
            'contactPerson' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|email',
            'deliveryAddress' => 'required|string',
            'postalCode' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
        ]);
        $collaboratorShipping = CollaboratorShipping::where('user_id', $request->user_id)->first();
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
                'user_id' => $request->user_id,
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
        return Redirect::route('admin.associates')->with(['id'=>$id, 'message' => 'Datos actualizados correctamente', 'code' => 200, 'status' => 'success']);
    }

    public function show_associate(User $user){
        $user->load('profile');
        return Inertia::render('Admin/Associates/Show', compact('user'));      
    }

}