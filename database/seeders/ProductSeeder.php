<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        //Dien thoai
        DB::table('products')->insert([
            'name' => 'Samsung Galaxy J7',
            'category_id' => 6,
            // 'brand_id' => 2,
            'price' => 2500000,
            'price_discount' => 2000000,
            'price_lever' => 2,
            'quantity_available' => 200,
            // 'quantity_sale' => 25,
            'short_descreption' => 'Ram 8gb',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/phones/m1.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'OPPO A37f',
            'category_id' => 4,
            // 'brand_id' => 5,
            'price' => 6000000,
            'price_discount' => 5200000,
            'price_lever' => 3,
            'quantity_available' => 250,
            // 'quantity_sale' => 50,
            'short_descreption' => 'Ram 6gb',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/phones/m2.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Iphone X',
            'category_id' => 5,
            // 'brand_id' => 10,
            'price' => 22000000,
            'price_discount' => 19000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 20,
            'short_descreption' => 'Ram 4gb',
            'descreption' => 'Rất ưng',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/phones/m3.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Vinsmart Active 1 plus',
            'category_id' => 7,
            // 'brand_id' => 4,
            'price' => 21000000,
            'price_discount' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 70,
            'short_descreption' => 'Ram 16gb',
            'descreption' => 'Rất tuyệt vời',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/phones/m2.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Vinsmart Active 4',
            'category_id' => 7,
            // 'brand_id' => 4,
            'price' => 21000000,
            'price_discount' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 70,
            'short_descreption' => 'Ram 32gb',
            'descreption' => 'Rất tuyệt vời',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/phones/m1.jpg'
        ]);

        // Laptop
        DB::table('products')->insert([
            'name' => 'HP Pavillion',
            'category_id' => 8,
            // 'brand_id' => 7,
            'price' => 19000000,
            'price_discount' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 200,
            // 'quantity_sale' => 25,
            'short_descreption' => 'CPU 1500',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/laptops/m4.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Macbook Pro',
            'category_id' => 10,
            // 'brand_id' => 11,
            'price' => 60000000,
            'price_discount' => 52000000,
            'price_lever' => 6,
            'quantity_available' => 250,
            // 'quantity_sale' => 50,
            'short_descreption' => 'CPU 1600',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/laptops/m5.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Asus Gen X',
            'category_id' => 9,
            // 'brand_id' => 8,
            'price' => 22000000,
            'price_discount' => 19000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 20,
            'short_descreption' => 'CPU 2300',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/laptops/m6.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Dell XPS 13',
            'category_id' => 11,
            // 'brand_id' => 6,
            'price' => 21000000,
            'price_discount' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 70,
            'short_descreption' => 'CPU 1200',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/laptops/m6.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Dell XP1500',
            'category_id' => 11,
            // 'brand_id' => 6,
            'price' => 21000000,
            'price_discount' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 70,
            'short_descreption' => 'CPU 2200',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/laptops/m5.jpg'
        ]);

        // Smart Watch
        DB::table('products')->insert([
            'name' => 'Apple Watch S6',
            'category_id' => 12,
            // 'brand_id' => 1,
            'price' => 19000000,
            'price_discount' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 200,
            // 'quantity_sale' => 25,
            'short_descreption' => 'Pin 4700',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/smartwatchs/m7.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Samsung Galaxy Watch Active2',
            'category_id' => 13,
            // 'brand_id' => 2,
            'price' => 60000000,
            'price_discount' => 52000000,
            'price_lever' => 6,
            'quantity_available' => 250,
            // 'quantity_sale' => 50,
            'short_descreption' => 'Pin 5000',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/smartwatchs/m8.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Realme 161',
            'category_id' => 14,
            // 'brand_id' => 9,
            'price' => 22000000,
            'price_discount' => 19000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 20,
            'short_descreption' => 'Pin 3000',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/smartwatchs/m9.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Huawei GT Elegant',
            'category_id' => 15,
            // 'brand_id' => 3,
            'price' => 21000000,
            'price_discount' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 70,
            'short_descreption' => 'Pin 5000',
            'descreption' => 'Rất đẹp',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/smartwatchs/m8.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Huawei GT Loyalty',
            'category_id' => 15,
            // 'brand_id' => 3,
            'price' => 21000000,
            'price_discount' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            // 'quantity_sale' => 70,
            'short_descreption' => 'Pin 6000',
            'descreption' => 'Rất sang trọng',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/smartwatchs/m7.jpg'
        ]);
=======
>>>>>>> c78ea0cad2a8271973854c321be7c71dd90a85be

        DB::table('products')->insert([
            'name' => 'Iphone 7 32GB',
            'category_id' => 5,
            // 'brand_id' => 3,
            'price' => 18000000,
            'price_lever' => 4,
            'quantity_available' => 150,
            'short_descreption' => 'Testing',
            'descreption' => 'Testing',
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'project/images/products/phones/iphone7-32gb.jpeg'
         ]);
    }

}
