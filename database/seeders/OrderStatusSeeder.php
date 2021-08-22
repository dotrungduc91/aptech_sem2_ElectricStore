<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('order_status')->insert([
        //     'name' => 'Đang giao hàng',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        DB::table('order_status')->insert([
            'name' => 'Đã giao hàng',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('order_status')->insert([
            'name' => 'Đã hủy',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
