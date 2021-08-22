<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OrderStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('order_status')->insert([
        //     'name' => 'Chờ Xác Nhận',
        //     'created_at' => now(),
        // ]);

        // DB::table('order_status')->insert([
        //     'name' => 'Đã Xác Nhận',
        //     'created_at' => now(),
        // ]);


        // DB::table('order_status')->insert([
        //     'name' => 'Đang Giao',
        //     'created_at' => now(),
        // ]);

        // DB::table('order_status')->insert([
        //     'name' => 'Đã Thanh Toán',
        //     'created_at' => now(),
        // ]);

        // DB::table('order_status')->insert([
        //     'name' => 'Đã Hủy',
        //     'created_at' => now(),
        // ]);

                DB::table('order_status')->insert([
            'name' => 'TEst',
            'created_at' => now(),
        ]);
    }
}
