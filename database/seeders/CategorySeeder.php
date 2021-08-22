<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dung cai nay thi anh phai xoa cai thuoc tinh unsigned trong bang de co the ghi -1 duoc
        DB::table('categories')->insert([
        	'name' => "Điện Thoại",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
        	'name' => "Smart Watch",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('categories')->insert([
        	'name' => "Laptop",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // dien thoai
        DB::table('categories')->insert([
        	'parent_id' => 1,
        	'name' => "Oppo",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 1,
        	'name' => "Iphone",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 1,
        	'name' => "Samsung",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 1,
        	'name' => "Vinsmart",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //laptop
        DB::table('categories')->insert([
        	'parent_id' => 3,
        	'name' => "HP",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 3,
        	'name' => "Asus",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 3,
        	'name' => "Mac",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 3,
        	'name' => "Dell",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //Smart Watch
        DB::table('categories')->insert([
        	'parent_id' => 2,
        	'name' => "Apple",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 2,
        	'name' => "Samsung",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 2,
        	'name' => "Realme",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categories')->insert([
        	'parent_id' => 2,
        	'name' => "Huawei",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
