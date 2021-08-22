<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThumbnailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('thumbnails')->insert([

            'product_id' => 21,
            'title' => 'Iphone 7 thumbnail 1',
            'thumbnail' => 'project/images/products/thumbnails/iphone7-1.jpeg'
        ]);
        
        DB::table('thumbnails')->insert([

            'product_id' => 21,
            'title' => 'Iphone 7 thumbnail 2',
            'thumbnail' => 'project/images/products/thumbnails/iphone7-2.jpeg'
        ]);
        DB::table('thumbnails')->insert([
            'product_id' => 21,
            'title' => 'Iphone 7 thumbnail 3',
            'thumbnail' => 'project/images/products/thumbnails/iphone7-3.jpeg'
        ]);
    }
}
