<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct() {
        $this->middleware('auth');
        $this->middleware('checkpermission');
    }

    public function index(Request $request)
    {
        $statusList = DB::table("order_status") ->get();

        $orderList = DB::table('orders')
            -> leftjoin('users', 'orders.user_id', '=', 'users.id')
            -> leftjoin ('order_status', 'orders.status_id', '=', 'order_status.id')
            -> select ('orders.*','orders.phone','orders.address', 'orders.order_date', 'users.name as user_name', 'order_status.id as order_status_id') 
            -> where('orders.status_id', '<>', '1')
            -> where('orders.is_deleted', '=', '0');    


        //tim kiem theo ten khach hang
        if (isset($request->customer_name) && $request->customer_name != '' ) {
            $orderList = $orderList ->where('users.name', 'like', '%'.$request->customer_name.'%');
        }

        //Sắp xếp theo ngày đặt hàng
        if ($request->sort == 'asc') {

                $orderList = $orderList ->orderBy('orders.order_date', 'asc');
            }else {
                $orderList = $orderList -> orderBy('orders.order_date', 'desc');
            }

            $orderList = $orderList ->paginate(10);


        //Đánh lại số thứ tự từng page paginate
        $num = 10;
        $index = 0;
        if (isset($request->page)) {
            $index = ($request->page - 1) * $num;
        }
       
        return view('admin.order.index')->with([
            'orderList' => $orderList,
             'statusList' => $statusList,
            'index' => $index,
            'customer_name' =>  $request->customer_name
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
       $orderDetails = DB::table('order_details')->leftjoin('products', 'order_details.product_id', '=', 'products.id') -> select('order_details.*','products.name as product_name', 'products.image as product_image') -> where([
            ['order_details.order_id', '=', $id],
        ]) ->get();


 

       return view('admin.order.details')->with([
            'orderDetails' => $orderDetails,
            'count' => 0
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $order_id = $id;
        $order = Order::find($order_id);
        $order->status_id = 5;

        $order->updated_at = now();
        //Kiem tra trang thai don hang, neu don hang da xac nhan bi Admin huy thi cong lại số lượng bảng products
        $status_order = $request->status_order;
        if ($status_order == 'confirmed') {

            $orderDetailsList = $order->orderdetails;

            $productList = Product::where([
                ['is_deleted', '=', '0'],
            ])->get();

            foreach ($orderDetailsList as $item) {
                foreach ( $productList as $product) {
                    if($item->product_id == $product->id){
                        $product->quantity_available = $product->quantity_available + $item->quantity;
                        $product->save();
                    }
                }
            }
        }
        //Kiem tra trang thai don hang,cong lại số lượng bảng products END
        
        $order->save();
    }

    public function updateOrderStatus(Request $request)
    {   
        $order_id = $request->order_id;
        $order = Order::find($order_id);
        $order->status_id = $request->status_id;
        $order->updated_at = now();
        $order->save();
        return 'Đã sửa trạng thái đơn hàng thành công';
    }

    public function pendingOrder(Request $request)
    {   
     $orderList = DB::table('orders') -> leftjoin('users', 'orders.user_id', '=', 'users.id') -> leftjoin ('order_status', 'orders.status_id', '=', 'order_status.id') -> select ('orders.*','orders.phone','orders.address', 'orders.order_date', 'users.name as user_name', 'order_status.name as order_status_name') -> where([
        ['orders.status_id', '=', '1'],
    ]);

        //tim kiem theo ten khach hang
     if (isset($request->customer_name) && $request->customer_name != '' ) {
        $orderList = $orderList ->where('users.name', 'like', '%'.$request->customer_name.'%');
    }

    if (isset($request->sort) && $request->sort != '' ) {
        if ($request->sort == 'asc') {
            $orderList = $orderList ->orderBy('orders.order_date', 'asc');
        }
    }

    $orderList = $orderList -> orderBy('orders.order_date', 'desc') ->paginate(20);

        //Đánh lại số thứ tự từng page paginate
    $num = 2;
    $index = 0;
    if (isset($request->page)) {
        $index = ($request->page - 1) * $num;
    }

    return view('admin.order.pending')->with([
        'orderList' => $orderList,
        'index' => $index,
        'customer_name' =>  $request->customer_name
    ]);
    }

    //Đối trạng thái đơn hàng Chưa Xác Nhân sang xác nhận, trừ đi số sản phẩm trong bảng products
    public function confirmOrder(Request $request, $id)
    {   
        //Đổi trạng thái đơn hàng
        $order_id = $id;
        $order = Order::find($order_id);
        $order->status_id = 2;
        $order->save();

        //Trừ đi sô sản phẩm
        $orderDetailsList = $order->orderdetails;

        $productList = Product::where([
            ['is_deleted', '=', '0'],
        ])->get();

        foreach ($orderDetailsList as $item) {
            foreach ( $productList as $product) {
                if($item->product_id == $product->id){
                    $product->quantity_available = $product->quantity_available - $item->quantity;
                    $product->save();
                }
            }
        }
         //Trừ đi sô sản phẩm End

        return redirect()->route('order_pending') -> with([
            'message' => "Xác nhận Đơn Hàng Thành Công",
        ]);
    }

   
}
