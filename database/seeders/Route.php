<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class Test extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	   DB::table('routes')->insert([
		'name' => 'category_index',
		'title' => 'Hiển thị danh sách danh mục sản phẩm',
	   ]);

       DB::table('routes')->insert([
		'name' => 'category_create',
		'title' => 'Hiển thị Form tạo danh mục sản phẩm mới',
	   ]);


	    DB::table('routes')->insert([
		'name' => 'category_edit',
		'title' => 'Hiển thị Form sửa danh mục sản phẩm',
	   ]);

	    // News

       DB::table('routes')->insert([
		'name' => 'news_index',
		'title' => 'Hiển thị danh sách tin tức',
	   ]);

       DB::table('routes')->insert([
		'name' => 'news_create',
		'title' => 'Hiển thị Form tạo tin tức mới',
	   ]);


	    DB::table('routes')->insert([
		'name' => 'news_edit',
		'title' => 'Hiển thị Form sửa tin tức',
	   ]);

	    //Product

	    DB::table('routes')->insert([
		'name' => 'product_index',
		'title' => 'Hiển thị danh sách sản phẩm',
	   ]);

       DB::table('routes')->insert([
		'name' => 'product_create',
		'title' => 'Hiển thị Form tạo sản phẩm mới',
	   ]);


	    DB::table('routes')->insert([
		'name' => 'product_edit',
		'title' => 'Hiển thị Form sửa sản phẩm',
	   ]);

	    // Order
	    DB::table('routes')->insert([
		'name' => 'order.index',
		'title' => 'Hiển thị đơn hàng đã xác nhận',
	   ]);

	    DB::table('routes')->insert([
	    	'name' => 'order.show',
	    	'title' => 'Hiển thị chi tiết đơn hàng',
	    ]);

	    DB::table('routes')->insert([
	    	'name' => 'order_pending',
	    	'title' => 'Hiển thị đơn hàng chờ xác nhận',
	    ]);

	    //Sale

	    DB::table('routes')->insert([
	    	'name' => 'sale_index',
	    	'title' => 'Hiển thị doanh số sản phẩm',
	    ]);
    }
}
