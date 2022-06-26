<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 30 ; $i++) { 
        	$dias= rand(1, 15);
        	$fecha = strtotime("+$dias days");
        	$date = date('Y-m-d', $fecha);
        	$total = rand(50, 400);
        	$order = Order::create([
        		'user_id' => 66,
        		'transaction_id' => 'dke3-dfr-3323',
        		'total' => $total,
        		'created_at' => $date,
        		'updated_at' => $date,
        		'ryder_id' => 1,
        		'send' => 1,
        		'hotel_id' => 1,
        		'returned' => 0,
        		'data' => null,
        		'status' => 'complete',
        		'total_s' => $total,
        		'shipping' => $total,
        		'type_order' => 'qr'
        	]);
        }
    }
}
