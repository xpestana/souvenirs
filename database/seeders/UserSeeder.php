<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\profile;
use App\Models\hotel;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*   Usuario Admin  */
        $userAdmin = User::updateOrCreate(
                ['email' => 'admin@email.com'],
                [
                    'name' => 'User Admin',
                    'password' =>  Hash::make('usuario12345'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

            $userAdminProfile = $userAdmin->profile()->updateOrCreate([
                'firstname'  => 'Usuario Admin',
                'lastname'   => 'Administrador principal',
                'gender'     => 'M',
                'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
            ]);

            $userAdmin->assignRole('Admin');
            /*******************************************************/
            /*Usuario Hotel*/

            $userHotel = User::updateOrCreate(
                ['email' => 'hotel@email.com'],
                [
                    'name' => 'User Hotel',
                    'password' =>  Hash::make('usuario12345'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

            $userHotelProfile = $userHotel->profile()->updateOrCreate([
                'firstname'  => 'Usuario',
                'lastname'   => 'Gerente Hotel',
                'gender'     => 'M',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $hotel = hotel::updateOrCreate([
                'name'       => 'nombre hotel',
                'type'       => 'hotel',
                'address'    => 'Direccion',
                'zone'       => 'Merida',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $userHotel->assignRole('Hotel');
            $userHotel->hotel()->attach($hotel->id, ['manager' => true]);
            
            /**********************************************************/
            /*Usuario operator: creados para ayudar a los hoteles*/

            $userOperator = User::updateOrCreate(
                ['email' => 'operator@email.com'],
                [
                    'name' => 'User Operator',
                    'password' =>  Hash::make('usuario12345'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );

            $userOperatorProfile = $userOperator->profile()->updateOrCreate([
                'firstname'  => 'Usuario',
                'lastname'   => 'Operador Hotel',
                'gender'     => 'F',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $userOperator->assignRole('Operator');
            $userOperator->hotel()->attach($hotel->id, ['manager' => false]);

    }
}
