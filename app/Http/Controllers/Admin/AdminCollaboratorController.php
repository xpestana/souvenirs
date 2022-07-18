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
use Illuminate\Support\Str;
use Inertia\Inertia;
use Image;


class AdminCollaboratorController extends Controller {

    public function index(Request $request)
    {
        $search = $request->search ?? null;

        $model = User::join('profiles', 'profiles.user_id', '=', 'users.id')
                ->select('users.*', 'profiles.firstname','profiles.lastname')
                ->role('Hotel')
                ->where('del',false)
                ->with('hotel.orders.shippings');
        
        !empty($search) ? $collaborators = $model->search($search)->email($search, 'Hotel') : '';

        $collaborators = $model->orderBy('profiles.firstname','ASC')->paginate(10);

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

        return Inertia::render('Admin/Collaborators',compact('collaborators'));
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
            'phone' => 'required|string',
        ]);

        $id = mt_Rand(1000000, 9999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->profile()->create([
            'firstname' => $request->name,
            'phone' => $request->phone,
            'gestor' => '1',
        ]);

        $user->assignRole('Hotel');

        return back()->with(['id'=>$id, 'message' => 'Guardado exitosamente', 'code' => 200, 'status' => 'success']); 
    }

}