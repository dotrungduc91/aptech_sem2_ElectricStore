<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use DB;

class SaleController extends Controller
{   
    public function __construct() {
    $this->middleware('auth');
    $this->middleware('checkpermission');
  }

    public function indexSale(Request $request)
    {
      $saleList = DB::table('orders') -> leftjoin('order_details', 'orders.id' ,'=', 'order_details.order_id') -> leftjoin('products', 'products.id', '=', 'order_details.product_id') ->leftjoin('order_status', 'orders.status_id','=','order_status.id')

       -> select('order_status.name as order_status_name','products.id as product_id','products.name as product_name', 'products.image as product_image',DB::raw('sum(order_details.quantity) as sale_quantity'),'order_details.price as product_price')
        -> groupBy('products.id','order_status.name','products.id','products.name','order_details.price')
         -> where([
            ['orders.is_deleted', '=', '0'],
            ['order_status.name', '=', 'Hoàn Thành'],
           ]);

           if (isset($request->product_name)) {
            $saleList =  $saleList->where('products.name', 'like', '%'.$request->product_name.'%');
        }

        if (isset($request->time_start)) {
           // $time_start = strtotime($request->time_start); 
           // $time_start = date('Y-m-d H:i:s', $time_start);
           $saleList =  $saleList->where('orders.updated_at', '>=', $request->time_start);
       }

       if (isset($request->time_end)) {
           // $time_end = strtotime($request->time_end); 
           // $time_end = date('Y-m-d H:i:s', $time_end);
           $saleList =  $saleList->where('orders.updated_at', '<=', $request->time_end);

       }

       if (isset($request->sort_quantity) && $request->sort_quantity != '' ) {
        if ($request->sort_quantity == 'asc') {
            $saleList = $saleList ->orderBy('sale_quantity', 'asc');
        }
    }
          $saleList = $saleList -> orderBy('sale_quantity', 'desc') ->paginate(10);

        //Đánh lại số thứ tự từng page paginate
        $num = 10;
        $index = 0;
        if (isset($request->page)) {
            $index = ($request->page - 1) * $num;
        }   

       return view('admin.sale.index')->with([
            'saleList' => $saleList,
            'index' => $index,
            'product_name' => $request->product_name,
            'sort_quantity' => $request->sort_quantity,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]); 
    }


   
}






      