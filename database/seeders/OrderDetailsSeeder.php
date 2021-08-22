<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('order_details')->insert([
    		'order_id' => '2',
    		'product_id' => '1',
    		'quantity' => '2',
    		'price' => '18000000',
    		'created_at' => '2021-07-30',
    		'updated_at' => '2021-07-30',
    	]);

    	DB::table('order_details')->insert([
    		'order_id' => '2',
    		'product_id' => '2',
    		'quantity' => '3',
    		'price' => '18000000',
    		'created_at' => '2021-07-30',
    		'updated_at' => '2021-07-30',
    	]);

    	DB::table('order_details')->insert([
    		'order_id' => '2',
    		'product_id' => '4',
    		'quantity' => '1',
    		'price' => '4500000',
    		'created_at' => '2021-07-30',
    		'updated_at' => '2021-07-30',
    	]);

    	DB::table('order_details')->insert([
    		'order_id' => '3',
    		'product_id' => '1',
    		'quantity' => '5',
    		'price' => '18000000',
    		'created_at' => '2021-07-29',
    		'updated_at' => '2021-07-29',
    	]);

    	DB::table('order_details')->insert([
    		'order_id' => '3',
    		'product_id' => '10',
    		'quantity' => '1',
    		'price' => '52000000',
    		'created_at' => '2021-07-29',
    		'updated_at' => '2021-07-29',
    	]);

    	DB::table('order_details')->insert([
    		'order_id' => '4',
    		'product_id' => '1',
    		'quantity' => '2',
    		'price' => '18000000',
    		'created_at' => '2021-07-25',
    		'updated_at' => '2021-07-25',
    	]);

    	DB::table('order_details')->insert([
    		'order_id' => '4',
    		'product_id' => '12',
    		'quantity' => '3',
    		'price' => '18000000',
    		'created_at' => '2021-07-25',
    		'updated_at' => '2021-07-25',
    	]);
    }
}
