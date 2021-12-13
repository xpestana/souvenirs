<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::table('roles')->upsert([
                [
                    'name' => 'Admin',
                    'guard_name' => 'web', 
                ],
                [
                    'name' => 'Client',
                    'guard_name' => 'web', 
                ],
                [
                    'name' => 'Hotel',
                    'guard_name' => 'web', 
                ]
            ], ['name', 'guard_name'], ['created_at','updated_at']);
        });
    }
}
