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
use App\Mail\DisplayReceiver;
use App\Mail\WelcomeReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Image;
use App\Models\CollaboratorBank;
use App\Models\CollaboratorShipping;

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

    public function show_details (Request $request, $id) {
        $user = User::join('profiles', 'profiles.user_id', '=', 'users.id')
                ->select('users.*', 'profiles.firstname','profiles.lastname')
                ->role('Hotel')
                ->where('del',false)
                ->with('hotel.orders.shippings')
                ->findOrFail($id);
        
        //Valid information perfil
        $validInformation = !empty($user->profile->firstname) && !empty($user->email) && !empty($user->profile->phone);
        $user['completInformation'] = $validInformation;

        //Valid information nif
        $validNif = !empty($user->profile->identify) && !empty($user->profile->nif) && !empty($user->profile->address) && !empty($user->profile->city);
        $user['completedNif'] = $validNif;

        //Valid information shipping
        $validShipping = !$user->collaboratorShippings->isEmpty();
        $user['completedShipping'] = $validShipping;

        //Valid information banck
        $validBank = !$user->collaboratorBanks->isEmpty();
        $user['completedBank'] = $validBank;

        //Valid banner
        $validBanner = $user->resources()->where('name', 'banner')->first();
        $user['completedBanner'] = !empty($validBanner);

        //Valid url
        $validUrl = $user->resources()->where('name', 'url')->first();
        $user['completedUrl'] = !empty($validUrl);

        //Valid request-display
        $validRequestDisplay = $user->resources()->where('name', 'request-display')->first();
        $user['completedRequestDisplay'] = !empty($validRequestDisplay);

        //Valid received-display
        $validReseivedDisplay = $user->resources()->where('name', 'received-display')->first();
        $user['completedReseivedDisplay'] = !empty($validReseivedDisplay);

        return Inertia::render('Admin/Collaborators/Show',compact('user'));
    }

    public function index_lodging (Request $request, $id) {
        $user = User::with('profile')->findOrFail($id);
        $hotels = $user->hotel()->search($request->buscar)->type($request->tipo)->paginate(3);
        $hotels->load('orders.shippings');
        $url = config('app.url');
        return Inertia::render('Admin/Collaborators/Lodging/Index', compact('hotels','url', 'user'));
    }

    public function store_lodging (Request $request) {
        if($request->tipo == 'hotel'){
            $request->validate([
                'tipo' => 'required|string',
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'code' => 'nullable|string',
                'cp' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
                'province' => 'required|string',
                'group' => 'required|string',
                'modality' => 'required|string',
                'category' => 'required|string',
                'user_id' => 'required'
            ]);
        }
        if ($request->tipo == 'apartamento') {
            $request->validate([
                'tipo' => 'required|string',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'address' => 'nullable|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'cp' => 'nullable|string',
                'code' => 'nullable|string',
                'url' => 'required|url',
                'area' => 'nullable|string',
                'user_id' => 'required'
            ]);
        }
        if ($request->tipo == 'complejo') {
            $request->validate([
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'nllaves' => 'required|string',
                'tipo' => 'required|string',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'cp' => 'nullable|string',
                'code' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
                'user_id' => 'required'
            ]);
        }
        $user = User::findOrFail($request->user_id);
        $image = $request->image;
        if ($image) {
            $msg =$this->valid($image);

            if ($msg['code']=='404')   return back()->with(['id'=>$msg['id'], 'message' => $msg['msg'], 'code' => $msg['code'], 'status' => 'error']);
        }

        try {
            $id = mt_Rand(1000000, 9999999);

            $Path = public_path('storage/hotel/');
            $pathName = '/';

            if (!file_exists($Path)) {
                mkdir($Path, 777, true);
            }
            if ($image) {
                $name_file = time() . '-' . $image->getClientOriginalName();
                $uploadSuccess = $image->move($Path, $name_file);
            }else{
                $name_file ="default.jpg";
            }
        
            $hotel = hotel::create([
                'name'        => $request->nombre_hotel ?? null,
                'hab'         => $request->numero_habitaciones ?? null,
                'calle'       => $request->calle,
                'type'        => $request->tipo,
                'address'     => $request->address ?? null,
                'zone'        => $request->city,
                'planta'      => $request->planta,
                'cp'          => $request->cp ?? null,
                'code'        => $request->code,
                'url'         => $request->url,
                'area'        => $request->area,
                'image'       => $pathName.$name_file,
                'province'    => $request->province,
                'group'       => $request->group,
                'modality'    => $request->modality,
                'category'    => $request->category,
                'nllaves'     => $request->nllaves ?? null,
            ]);
            $clientUser = User::create([
                'name' => $user->email,
                'email' => $user->email.$hotel->id,
                'password' => Hash::make("usuario123456"),
            ]);
            
            $user->hotel()->attach($hotel->id, ['manager' => true]);
            
            $clientUser->assignRole('Client');
            $clientUser->hotel()->attach($hotel->id, ['manager' => false]);
            $random = mt_Rand(1000000, 9999999);
            return back()->with(['id'=>$random, 'message' => 'Actualizado exitosamente', 'code' => 200, 'status' => 'success']);   
        } catch (Exception $e) {
            
        }
    }

    public function update_lodging (Request $request) {
        if($request->tipo == 'hotel'){
            $request->validate([
                'tipo' => 'required|string',
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'code' => 'nullable|string',
                'cp' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
                'province' => 'required|string',
                'group' => 'required|string',
                'modality' => 'required|string',
                'category' => 'required|string',
            ]);
        }
        if ($request->tipo == 'apartamento') {
            $request->validate([
                'tipo' => 'required|string',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'address' => 'nullable|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'cp' => 'nullable|string',
                'code' => 'nullable|string',
                'url' => 'required|url',
                'area' => 'nullable|string',
            ]);
        }
        if ($request->tipo == 'complejo') {
            $request->validate([
                'nombre_hotel' => 'required|string',
                'numero_habitaciones' => 'required|numeric',
                'nllaves' => 'required|string',
                'tipo' => 'required|string',
                'calle' => 'required|string',
                'planta' => 'required|string',
                'city' => 'required|string',
                'province' => 'required|string',
                'cp' => 'nullable|string',
                'code' => 'nullable|string',
                'url' => 'nullable|url',
                'area' => 'nullable|string',
            ]);
        }

        try{
            if ($request->file('image')) {
                $image = $request->image;
                $msg =$this->valid($image);
                if ($msg['code']=='404')   return back()->with(['id'=>$msg['id'], 'message' => $msg['msg'], 'code' => $msg['code'], 'status' => 'error']);

                $Path = public_path('storage/hotel/');
                $pathName = '/';

                if (!file_exists($Path)) {
                    mkdir($Path, 777, true);
                }

                $name_file = time() . '-' . $image->getClientOriginalName();
                $uploadSuccess = $image->move($Path, $name_file);

            }
            $hotel = hotel::find($request->id);
            $hotel->name = $request->nombre_hotel ?? null;
            $hotel->hab  = $request->numero_habitaciones ?? null;
            $hotel->calle = $request->calle;
            $hotel->address = $request->address ?? null;
            $hotel->zone = $request->city;
            $hotel->planta = $request->planta;
            $hotel->cp = $request->cp ?? null;
            $hotel->code = $request->code;
            $hotel->url = $request->url;
            $hotel->area = $request->area;
            $hotel->province = $request->province;
            $hotel->group = $request->group;
            $hotel->modality = $request->modality;
            $hotel->category = $request->category;
            $hotel->nllaves = $request->nllaves ?? null;
            if ($request->file('image')) {
                $hotel->image = $pathName.$name_file;
            }
            $hotel->save();
            $random = mt_Rand(1000000, 9999999);
            return back()->with(['id'=>$random, 'message' => 'Actualizado exitosamente', 'code' => 200, 'status' => 'success']);   
         }catch (Exception $e)
         {
        
         }
    }

    public function request_display(Request $request){
        $user = User::findOrFail($request->user_id);
        $data = [
            'user' => $user,
        ];
        $user->resources()->createMany([
            ['name' => 'request-display', ],
            ['name' => 'received-display'],

        ]);
        Mail::to("info@hicitty.es")->send(new DisplayReceiver($data));
        return back();
    }

    public function create_profile ($id) {
        $user = User::with('profile')->findOrFail($id);
        return Inertia::render('Admin/Collaborators/Profile/Info',compact('user'));
    }

    public function update_profile(Request $request, $profile)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
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
        return Redirect::route('admin.colaboradores')->with(['id'=>$id, 'message' => 'Datos actualizados correctamente', 'code' => 200, 'status' => 'success']);
    }


    public function create_tax ($id) {
        $user = User::findOrFail($id);
        $user->load('profile');
        return Inertia::render('Admin/Collaborators/Profile/Tax',compact('user'));
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
        return Redirect::route('admin.colaboradores')->with(['id'=>$id, 'message' => 'Datos actualizados correctamente', 'code' => 200, 'status' => 'success']);
    }

    public function create_bank ($id) {
        $user = User::with('profile')->findOrFail($id);
        $collaboratorBanks = $user->collaboratorBanks;
        if ($collaboratorBanks->count() > 0) {
            $collaboratorBank = $collaboratorBanks[0];
        } else {
            $collaboratorBank = [
                'holder' => '',
                'iban' => '',
            ];
        }
        return Inertia::render('Admin/Collaborators/Profile/Bank',compact('collaboratorBank', 'user'));
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
        return Redirect::route('admin.colaboradores')->with(['id'=>$id, 'message' => 'Datos actualizados correctamente', 'code' => 200, 'status' => 'success']);
    }
    
    public function create_shipping ($id) {
        $user = User::with('profile')->findOrFail($id);
        $collaboratorShippings = $user->collaboratorShippings;
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
        return Inertia::render('Admin/Collaborators/Profile/Shipping',compact('collaboratorShipping', 'user'));
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
        return Redirect::route('admin.colaboradores')->with(['id'=>$id, 'message' => 'Datos actualizados correctamente', 'code' => 200, 'status' => 'success']);
    }

    public function index_sales_property (Request $request, $id) {
        $user = User::with('profile')->findOrFail($id);
    	$hotels = $user->hotel->load('orders.shippings'); 
        $model = Order::whereIn('hotel_id',$hotels->pluck('id'))
                        ->where('type_order', '1')
                        ->where("status", "complete")
                        ->with('hotel', 'shippings')
                        ->Date($request->from, $request->to)
                        ->orderBy('id', 'desc')
                        ->paginate(8);
        $orders = $model->appends(request()->except('page'));

        $totalorders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                        ->where('type_order', '1')
                        ->where("status","complete")
                        ->with('hotel','shippings')
                        ->Date($request->desde, $request->hasta)->get();

         $orderLast = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where('type_order', '1')
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)
                    ->where("withdrawal",1)->orderBy('id', 'desc')->first();
        $dateLast = $orderLast ? $orderLast->updated_at : null;

        $withdrawal = $orders->where("withdrawal",0);
        $date = null;
        if (!$withdrawal->isEmpty()) {
            $date = $withdrawal->last()->updated_at; 
        }

        return Inertia::render('Admin/Collaborators/Sales/During',compact('hotels','orders','date', 'dateLast', 'user', 'totalorders'));
    }

    public function index_sales_publicity (Request $request, $id) {
        $user = User::with('profile')->findOrFail($id);
    	$hotels = $user->hotel->load('orders.shippings'); 
        $model = Order::whereIn('hotel_id',$hotels->pluck('id'))
                        ->where('type_order', '2')
                        ->where("status", "complete")
                        ->with('hotel', 'shippings')
                        ->Date($request->from, $request->to)
                        ->orderBy('id', 'desc')
                        ->paginate(8);
        $orders = $model->appends(request()->except('page'));

        $totalorders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                        ->where('type_order', '2')
                        ->where("status","complete")
                        ->with('hotel','shippings')
                        ->Date($request->desde, $request->hasta)->get();
        
        $orderLast = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where('type_order', '2')
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)
                    ->where("withdrawal",1)->orderBy('id', 'desc')->first();
        $dateLast = $orderLast ? $orderLast->updated_at : null;

        $withdrawal = $orders->where("withdrawal",0);
        $date = null;
        if (!$withdrawal->isEmpty()) {
            $date = $withdrawal->last()->updated_at; 
        }

        return Inertia::render('Admin/Collaborators/Sales/Publicity',compact('orders', 'dateLast', 'date', 'hotels', 'totalorders', 'user'));
    }

    public function index_sales_total(Request $request, $id){
        $user = User::with('profile')->findOrFail($id);
        $hotels = $user->hotel->load('orders.shippings');
        $orders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)
                    ->paginate(8)
                    ->appends(request()->except('page'));
        $totalorders = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)->get();
        $withdrawal = $orders->where("withdrawal",0);

        $orderLast = Order::whereIn('hotel_id',$hotels->pluck('id'))
                    ->where("status","complete")
                    ->with('hotel','shippings')
                    ->Date($request->desde, $request->hasta)
                    ->where("withdrawal",1)->orderBy('id', 'desc')->first();
        $dateLast = $orderLast ? $orderLast->updated_at : null;

        $date = null;

        if (!$withdrawal->isEmpty()) {
            $date = $withdrawal->first()->updated_at;
        }
        return Inertia::render('Admin/Collaborators/Sales/Total',compact('hotels','orders','date','totalorders', 'dateLast', 'user'));
    }

    public function send_notify(Request $request){
        $user = User::findOrFail($request->id);
        $hotels = $user->hotel->load('orders.shippings');

        foreach ($hotels as $hotel) {
            $orders = Order::where('hotel_id',$hotel->id)->where("status","complete")->get();

            foreach ($orders as $order) {
                $updt = Order::find($order->id);
                $updt->withdrawal = 1;
                $updt->save();
            }
        }

        // return back();
        
    }

    public function create_resource ($id) {
        $user = User::with('profile')->findOrFail($id);

        //Valid banner
        $validBanner = $user->resources()->where('name', 'banner')->first();
        $user['completedBanner'] = !empty($validBanner);

        //Valid url
        $validUrl = $user->resources()->where('name', 'url')->first();
        $user['completedUrl'] = !empty($validUrl);

        //Valid request-display
        $validRequestDisplay = $user->resources()->where('name', 'request-display')->first();
        $user['completedRequestDisplay'] = !empty($validRequestDisplay);

        //Valid received-display
        $validReseivedDisplay = $user->resources()->where('name', 'received-display')->first();
        $user['completedReseivedDisplay'] = !empty($validReseivedDisplay);

        return Inertia::render('Admin/Collaborators/Resource/Index',compact('user'));
    }

    public function url (Request $request) {
        $city = $request->city ?? null;
        $url = null;
        $user = User::with('profile')->findOrFail($request->user_id);
        if ($city) {
            $idUser = $user->id;
            $url = url('?p='.$city.'&c='.$idUser.'&t=2');
        }

        $user->resources()->create([
            'name' => 'url',
        ]);

        //Valid url
        $validUrl = $user->resources()->where('name', 'url')->first();
        $completedUrl = !empty($validUrl);

        return response()->json(['url' => $url, 'completedUrl' => $completedUrl]);
    }

    public function banner (Request $request) {
        $city = $request->city ?? null;
        $width = $request->width ?? null;
        $url = [
            'path' => null,
            'fullPath' => null,
            'href' => null,
        ];
        $user = User::with('profile')->findOrFail($request->user_id);
        if ($city && $width) {
            $idUser = $user->id;
            $url['href'] = url('?p='.$city.'&c='.$idUser.'&t=2');
            if ($city == 'Sevilla' && $width == '160x600') {
                $url['path'] = 'vendor_asset/img/collaborator/dashboard/banners/160x600.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
            if ($city == 'Sevilla' && $width == '200x700') {
                $url['path'] = 'vendor_asset/img/collaborator/dashboard/banners/200x700.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
            if ($city == 'Sevilla' && $width == '728x90') {
                $url['path'] =  'vendor_asset/img/collaborator/dashboard/banners/728x90.png';
                $url['fullPath'] = url('/'.$url['path']);
            }
        }
        
        $user->resources()->create([
            'name' => 'banner',
        ]);

         //Valid url
         $validBanner = $user->resources()->where('name', 'banner')->first();
         $completedBanner = !empty($validBanner); 

        return response()->json(['url' => $url, 'completedBanner' => $completedBanner]);
    }

}