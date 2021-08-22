<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('orders')->insert([
            'user_id' => '4',
            'phone' => '0985764267',
            'address' => 'Ha Noi',
            'order_date' => '2021/07/30',
            'status_id' => '1',
            'created_at' => '2021/07/30',
            'updated_at' => '2021/07/30',
        ]);

        DB::table('orders')->insert([
            'user_id' => '5',
            'phone' => '0985123456',
            'address' => 'Ha Noi',
            'order_date' => '2021/07/29',
            'status_id' => '1',
            'created_at' => '2021/07/25',
            'updated_at' => '2021/07/25',
        ]);


        DB::table('orders')->insert([
            'user_id' => '4',
            'phone' => '0985764267',
            'address' => 'Ha Noi',
            'order_date' => '2021/07/25',
            'status_id' => '1',
            'created_at' => '2021/07/25',
            'updated_at' => '2021/07/25',
        ]);
	}
}
