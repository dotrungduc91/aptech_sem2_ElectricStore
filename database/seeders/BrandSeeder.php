<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name' => 'Apple',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Samsung',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Huawei',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Vinsmart',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Oppo',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Dell',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'HP',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Asus',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Realme',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Iphone',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('brands')->insert([
            'name' => 'Mac',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
