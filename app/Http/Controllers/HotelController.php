<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Redirect;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Pruebas/Show_hotel',['hotels' => hotel::all()->load('user')]);
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

        $validator = $this->validate($request, [
            'name'              => 'required|string',
            'email'             => 'required|string|email|max:255|unique:users',
            'type'              => 'required|string', 'in:apartament,hotel',
            'address'           => 'required|string',
            'zone'              => 'required|string',
        ]);

        try {
            $id = mt_Rand(1000000, 9999999);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::lower(Str::random(8))),
            ]);

            $hotel = hotel::create([
                'user_id' => $user->id,
                'type' => $request->type,
                'address' => $request->address,
                'zone' => $request->zone,
            ]);
            $user->assignRole('Hotel');
        return Redirect::route('register.hotel')->with(['id'=>$id, 'message' => 'Update Success', 'code' => 200, 'status' => 'success']);  
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
