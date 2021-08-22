<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function test(Request $request)
    {
        $saleList = DB::table('orders')
        -> leftjoin('order_details', 'orders.id' ,'=', 'order_details.order_id') 
        -> leftjoin('products', 'products.id', '=', 'order_details.product_id') 
        -> leftjoin('order_status', 'orders.status_id','=','order_status.id')
        -> select('order_status.name as order_status_name','products.id as product_id','products.name as product_name', DB::raw('SUM(order_details.quantity) as sale_quantity'),'order_details.price as product_price')
        -> groupBy('products.id')
        -> where('order_status.name', '=', 'Đã giao hàng')
        -> get();
        // $list = DB::table('products')
        // ->leftJoin('carts','carts.product_id','=','products.id')
        // ->leftJoin('categories','products.category_id','=','categories.id')
        // ->select('products.*',DB::raw('COALESCE(SUM(carts.quantity),0) as quantity_sale'),'categories.parent_id')
        // ->groupBy('products.id')
        // ->orderBy('quantity_sale','desc')
        // ->get();
        var_dump($saleList);
    }
    //Index
    public function index(Request $request)
    {
        //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();

        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();

        //Lấy ra sản phẩm đã được sắp xếp theo thứ tự giảm dần của quantity_sale + leftjoin bảng category để lấy parent_id
        $productList = DB::table('products')
        ->leftJoin('order_details','order_details.product_id','=','products.id')
        ->leftJoin('categories','products.category_id','=','categories.id')
        ->where('products.is_deleted',0)
        ->where('categories.is_deleted',0)
        ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'),'categories.parent_id')
        ->groupBy('products.id')
        ->orderBy('quantity_sale','desc')
        ->get();

        $productListTime =[];
        //Lấy ra sản phẩm đã được sắp xếp theo thứ tự gần nhất của time của + leftjoin bảng category để lấy parent_id
        foreach ($productList as $product) {
            if (time() - strtotime($product->created_at) < 20*24*60*60 ) {
                $productListTime[] = $product;
            }
        }
        return view('client.index.index')->with([
            'categoryP' => $categoryP,
            'categoryC' => $categoryC,
            'productList' => $productList,
            'productListTime' => $productListTime,
            'count' => 0,
            'idCategory' => ''
        ]);
    }

    //Product
    public function product(Request $request)
    {
        $idCategory = $request->idCategory;
        $search = $request->s;
        $price_level = $request->price_level;

        //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();

        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();

        if (isset($idCategory) && $idCategory > 0) {
            //Lay ra category theo id truyen vao
            $category = DB::table('categories')
            ->where('id',$idCategory)
            ->where('is_deleted',0)
            ->get();
            //Neu cai category truyen vao da bi xoa thi in ra tất cả sản phẩm
            if (count($category) == 0) {
                //neu price_level ton tai
                if (isset($price_level) && $price_level > 0) {
                    //Đổ ra full sản phẩm theo search
                    $title = "Sản phẩm";
                    $productList = DB::table('products')
                    ->leftJoin('order_details','order_details.product_id','=','products.id')
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->where('products.name','like','%'.$search.'%')
                    ->where('products.price_level',$price_level)
                    ->where('categories.is_deleted',0)
                    ->where('products.is_deleted',0)
                    ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                    ->groupBy('products.id')
                    ->paginate(9);
                }else{
                    //Price level ko tồn tại
                    //Đổ ra full sản phẩm theo search
                    $title = "Sản phẩm";
                    $productList = DB::table('products')
                    ->leftJoin('order_details','order_details.product_id','=','products.id')
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->where('products.name','like','%'.$search.'%')
                    ->where('categories.is_deleted',0)
                    ->where('products.is_deleted',0)
                    ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                    ->groupBy('products.id')
                    ->paginate(9);
                }
                //San pham hot
                $productListHot =DB::table('products')
                ->leftJoin('order_details','order_details.product_id','=','products.id')
                ->leftJoin('categories','products.category_id','=','categories.id')
                ->where('products.is_deleted',0)
                ->where('categories.is_deleted',0)
                ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                ->groupBy('products.id')
                ->orderBy('quantity_sale','desc')
                ->limit(3)
                ->get();
                return view('client.product.product')->with([
                    'categoryP' => $categoryP,
                    'categoryC' => $categoryC,
                    'idCategory' => $idCategory,
                    'productList' => $productList,
                    'title' => $title,
                    'search' => $search,
                    'productListHot' => $productListHot,
                    'price_level' => $price_level
                ]);
            }
            //Lay ten cua category do
            $title = $category[0]->name;
            
            //Neu price_level ton tai
            if(isset($price_level) && $price_level>0){
                //Neu la category cha
                if ($category[0]->parent_id == 0) {
                    $productList = DB::table('products')
                    ->leftJoin('order_details','order_details.product_id','=','products.id')
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->where('categories.parent_id',$idCategory)
                    ->where('products.name','like','%'.$search.'%')
                    ->where('price_level',$price_level)
                    ->where('products.is_deleted',0)
                    ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                    ->groupBy('products.id')
                    ->paginate(9);
                }else{
                    //Neu la category con
                    $productList = DB::table('products')
                    ->leftJoin('order_details','order_details.product_id','=','products.id')
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->where('category_id',$idCategory)
                    ->where('products.name','like','%'.$search.'%')
                    ->where('price_level',$price_level)
                    ->where('products.is_deleted',0)
                    ->where('categories.is_deleted',0)
                    ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                    ->groupBy('products.id')
                    ->paginate(9);
                }
            }else{
                //Neu la category cha
                if ($category[0]->parent_id == 0) {
                    $productList = DB::table('products')
                    ->leftJoin('order_details','order_details.product_id','=','products.id')
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->where('categories.parent_id',$idCategory)
                    ->where('products.name','like','%'.$search.'%')
                    ->where('products.is_deleted',0)
                    ->where('categories.is_deleted',0)
                    ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                    ->groupBy('products.id')
                    ->paginate(9);
                }else{
                    //Neu la category con
                    $productList = DB::table('products')
                    ->leftJoin('order_details','order_details.product_id','=','products.id')
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->where('category_id',$idCategory)
                    ->where('products.name','like','%'.$search.'%')
                    ->where('products.is_deleted',0)
                    ->where('categories.is_deleted',0)
                    ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                    ->groupBy('products.id')
                    ->paginate(9);
                }
            }
            //San pham hot
            if ($category[0]->parent_id == 0) {
                //Neu la category bo
                $productListHot = DB::table('products')
                ->leftJoin('order_details','order_details.product_id','=','products.id')
                ->leftJoin('categories','products.category_id','=','categories.id')
                ->where('categories.parent_id',$idCategory)
                ->where('products.is_deleted',0)
                ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                ->groupBy('products.id')
                ->orderBy('quantity_sale','desc')
                ->limit(3)
                ->get();
            }else{
                //Neu la category con
                $productListHot = DB::table('products')
                ->leftJoin('order_details','order_details.product_id','=','products.id')
                ->where('category_id',$idCategory)
                ->where('products.is_deleted',0)
                ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                ->groupBy('products.id')
                ->orderBy('quantity_sale','desc')
                ->limit(3)
                ->get();
            }
        }else{
            //neu price_level ton tai
            if (isset($price_level) && $price_level > 0) {
                //Đổ ra full sản phẩm theo search
                $title = "Sản phẩm";
                $productList = DB::table('products')
                ->leftJoin('order_details','order_details.product_id','=','products.id')
                ->leftJoin('categories','products.category_id','=','categories.id')
                ->where('products.name','like','%'.$search.'%')
                ->where('products.price_level',$price_level)
                ->where('categories.is_deleted',0)
                ->where('products.is_deleted',0)
                ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                ->groupBy('products.id')
                ->paginate(9);
            }else{
                //Đổ ra full sản phẩm theo search
                $title = "Sản phẩm";
                $productList = DB::table('products')
                ->leftJoin('order_details','order_details.product_id','=','products.id')
                ->leftJoin('categories','products.category_id','=','categories.id')
                ->where('products.name','like','%'.$search.'%')
                ->where('categories.is_deleted',0)
                ->where('products.is_deleted',0)
                ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
                ->groupBy('products.id')
                ->paginate(9);
            }
            //San pham hot
            $productListHot =DB::table('products')
            ->leftJoin('order_details','order_details.product_id','=','products.id')
            ->leftJoin('categories','products.category_id','=','categories.id')
            ->where('products.is_deleted',0)
            ->where('categories.is_deleted',0)
            ->select('products.*',DB::raw('SUM(order_details.quantity) as quantity_sale'))
            ->groupBy('products.id')
            ->orderBy('quantity_sale','desc')
            ->limit(3)
            ->get();
        }
        // var_dump($productList);
        return view('client.product.product')->with([
            'categoryP' => $categoryP,
            'categoryC' => $categoryC,
            'idCategory' => $idCategory,
            'productList' => $productList,
            'title' => $title,
            'search' => $search,
            'productListHot' => $productListHot,
            'price_level' => $price_level
        ]);
        
    }

    //Single
    public function single(Request $request, $id)
    {
        // $idProduct = $request->idproduct;
        $idProduct = $id;
        //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();

        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();
        if (isset($idProduct) && $idProduct > 0) {
            $product = DB::table('products')
            ->leftJoin('order_details','order_details.product_id','=','products.id')
            ->leftJoin('categories','products.category_id','=','categories.id')
            ->where('products.id',$idProduct)
            ->where('products.is_deleted',0)
            ->where('categories.is_deleted',0)
            ->select('products.*',DB::raw('SUM(order_details.quantity) as quantity_sale'))
            ->get();
            //Nếu sản phẩm đó đã bị xóa
            if(!count($product)) return redirect(route('client_product'));
        }else{
            return redirect(route('client_product'));
        }
        //Lay ra cac thumbnails cua product do
        $thumbnailList = DB::table('thumbnails')
        ->where('product_id',$idProduct)
        ->limit(3)
        ->get();
        return view('client.single.single')->with([
            'categoryP' => $categoryP,
            'categoryC' => $categoryC,
            'product' => $product[0],
            'thumbnailList' => $thumbnailList
        ]);
    }

    //Checkout + AddDB
    public function checkout(Request $request)
    {
        var_dump($request->all());
        if (!Auth::check()) {
            return redirect(route('login'));
        }
        //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();

        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();
        //lay ra id cua product dang huong toi
        $idProduct = $request->idProduct;
        //Lay ra san pham do
        $product = DB::table('products')
        ->where('id',$idProduct)
        ->get();
        //lay ra id nguoi dung
        $idUser = Auth::id();
        //lay san pham do ra xem da ton tai hay chua
        $cart = DB::table('carts')
        ->where('user_id',$idUser)
        ->where('product_id',$idProduct)
        ->get();
        //neu ton tai thi update tang so luong san pham len them 1 don vi
        if(isset($cart) && count($cart) > 0){
            DB::table('carts')
            ->where('user_id',$idUser)
            ->where('product_id',$idProduct)
            ->update([
                'quantity' => $cart[0]->quantity+1
            ]);
        }else{
            DB::table('carts')->insert([
                'user_id' => $idUser,
                'product_id' => $idProduct,
                'quantity' => 1,
                'price' => ($product[0]->price_discount > 0) ?$product[0]->price_discount:$product[0]->price,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        return redirect(route('client_showCart'));
    }

    //Update Quantity
    public function update(Request $request)
    {
        $value = $request->value;
        $idProduct = $request->idProduct;
        $idUser = Auth::id();
        $status = $request->status;
        if (isset($status)) {
            DB::table('carts')
            ->where('user_id',$idUser)
            ->where('product_id',$idProduct)
            ->delete();
            return;
        }
        DB::table('carts')
        ->where('user_id',$idUser)
        ->where('product_id',$idProduct)
        ->update([
            'quantity' => $value,
            'updated_at' => now()
        ]);
    }

    //CheckCart
    public function showCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }
        //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();
        $idUser = Auth::id();
        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();
        $cartList = DB::table('carts')
        ->leftJoin('products','products.id','=', 'carts.product_id')
        ->where('user_id',$idUser)
        ->where('products.is_deleted',0)
        ->select('carts.*','products.image','products.name as product_name')
        ->get();
        return view('client.checkout.checkout')->with([
            'cartList' => $cartList,
            'categoryC' => $categoryC,
            'categoryP' => $categoryP,
            'index' => 1
        ]);
    }

    //Xử lí đơn hàng
    public function process(Request $request)
    {
        $idUser = Auth::id();
        //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();
        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();
        //lay ra danh sach cart
        $cartList = DB::table('carts')
        ->leftJoin('products','products.id','=', 'carts.product_id')
        ->where('user_id',$idUser)
        ->where('products.is_deleted',0)
        ->select('carts.*','products.image','products.name')
        ->get();
        // $cartList = json_decode($request->cartList);
        //Lấy ra các sản phẩm kèm theo quantity_sale
        $list = DB::table('products')
        ->leftJoin('order_details','order_details.product_id','=','products.id')
        ->select('products.*',DB::raw('COALESCE(SUM(order_details.quantity),0) as quantity_sale'))
        ->groupBy('products.id')
        ->get();
        //danh sach nhung mat hang khong mua duoc
        $listFail = [];
        foreach($cartList as $cartItem){
            foreach ($list as $product) {
                if($product->id == $cartItem->product_id){
                    if ( ($cartItem->quantity > $product->quantity_available) || $product->quantity_available <= 0) {
                        $listFail[]=[
                            'id' => $product->id,
                            'name' => $product->name,
                            'image' => $product->image,
                            'quantity_available' => $product->quantity_available,
                            'href_param' => $product->href_param
                        ];
                    }
                    break;
                }
            }
        }              
        //neu danh sach mat hang ko mua duoc ton tai
        if(count($listFail) > 0){
            return view('client.fail.fail')->with([
                'categoryP' =>$categoryP,
                'categoryC' =>$categoryC,
                'listFail' => $listFail,
                'index' => 1
            ]);
        }else{
            // cập nhật lên bảng orders và đồng thời lấy luôn id
            $order_id = DB::table('orders')->insertGetId([
                'user_id' => $idUser,
                'phone' => $request->phone,
                'address' => $request->address,
                'order_date' => now(),
                'status_id' => 1, // 1 la dang giao hang

                'created_at' => now(),
                'updated_at' => now(),
                'is_deleted' => 0,
            ]);
            // cập nhật lên bảng order_details
            foreach($cartList as $cartItem){
                DB::table('order_details')->insert([
                    'order_id' => $order_id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'is_deleted' => 0,
                ]);
            }
            //xóa dữ liệu trong cart
            DB::table('carts')
            ->where('user_id',$idUser) 
            ->delete();               
            return view('client.success.success')->with([
                'categoryP' =>$categoryP,
                'categoryC' =>$categoryC
            ]);
        }
    }

    //User info
    public function userInfo(Request $request)
    {
        $user = Auth::user();
        //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();
        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();
        $orderList = DB::table('orders')
        ->where('user_id',$user->id)
        ->where('is_deleted',0)
        ->orderBy('order_date','desc')
        ->get();
        return view('client.user.user')->with([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'address' => $user->address,
            'categoryP' =>$categoryP,
            'categoryC' =>$categoryC,
            'orderList' => $orderList
        ]);
    }

    //OrderDetails
    public function orderDetails(Request $request, $id)
    {
        //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();
        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();

        //Lay ra kiem tra xem is_delete trong order do co bang 0 ko
        $order = DB::table('orders')
        ->where('id',$id)
        ->get(); 
        if ($id <= 0 || !count(DB::table('orders')->where('user_id',Auth::id())->where('id',$id)->get()) || $order[0]->is_deleted) {
            return view('client.order.order')->with([
                'categoryP' =>$categoryP,
                'categoryC' =>$categoryC,
                'status' => 'fail'
            ]);
        }
        $orderList = DB::table('order_details')
        ->leftJoin('products','order_details.product_id','=','products.id')
        ->where('order_id',$id)
        ->where('products.is_deleted',0)
        ->where('order_details.is_deleted',0)
        ->select('order_details.*','products.name','products.image')
        ->get();
        return view('client.order.order')->with([
            'categoryP' =>$categoryP,
            'categoryC' =>$categoryC,
            'orderList' => $orderList,
            'index' => 1
        ]);
        
    }

    //Delete Order
    public function deleteOrder(Request $request)
    {
        $idOrder = $request->id;
        $order = DB::table('orders')
        ->where('id',$idOrder)
        ->get();

        //Nếu đã xác nhận đơn hàng
        if($order[0]->status_id != 1){
            //Lay ra cac san pham theo don hang do
            $orderDetailList = DB::table('order_details')
            ->where('order_id',$idOrder)
            ->get();
            //Chay qua tung san pham
            foreach ($orderDetailList as $item) {
                //Lay ra san pham do
                $product = DB::table('products')
                ->where('id',$item->product_id)
                ->get();
                //Cong lai quantity
                DB::table('products')
                ->where('id',$item->product_id)
                ->update([
                    'quantity_available' => $product[0]->quantity_available + $item->quantity 
                ]);
            }
        }
        DB::table('orders')
        ->where('id',$idOrder)
        ->update([
            'status_id' => 5 
        ]);
    }

    //User Update
    public function userUpdate(Request $request)
    {
        $idUser = Auth::id();
        DB::table('users')
        ->where('id',$idUser)
        ->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => now()
        ]);
    }

    //Privacy
    public function privacy(Request $request)
    {
        return view('client.privacy.privacy');
    }

    //Payment
    public function payment(Request $request)
    {
        return view('client.payment.payment');
    }

    //Terms
    public function terms(Request $request)
    {
        return view('client.terms.terms');
    }

    //Faqs
    public function faqs(Request $request)
    {
        return view('client.faqs.faqs');
    }

    //Help
    public function help(Request $request)
    {
        return view('client.help.help');
    }
    
    //Contact
    public function contact(Request $request)
    {
        return view('client.contact.contact');
    }
    
    //About
    public function about(Request $request)
    {
        return view('client.about.about');
    }

    //News
    public function news(Request $request)
    {   
                //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();
        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();

        $number = 10;
        $newsList = DB::table('news')
        ->where('is_deleted', 0)
        ->paginate($number);

        $index = 0;
        if (isset($request->page) && $request->page > 0) {
            $index = ($request->page - 1) * $number;
        }

        return view('client.news.news')->with([
            'newsList' => $newsList,
            'index'  => $index,
            'categoryP' =>$categoryP,
            'categoryC' =>$categoryC,
        ]);
    }

        public function newsDetails(Request $request, $id, $href_param)
    {   

         //Lấy ra danh sách bố
        $categoryP = DB::table('categories')
        ->where('parent_id',0)
        ->where('is_deleted',0)
        ->get();
        //Lấy ra danh sách con
        $categoryC = DB::table('categories')
        ->where('parent_id','<>',0)
        ->where('is_deleted',0)
        ->get();
        $newsDetails = DB::table('news')
        ->where('is_deleted', 0)
        ->where('id',$id)
        ->get();

        $newsDetails = $newsDetails[0];

        return view('client.news.details')->with([
            'newsDetails' => $newsDetails,
            'categoryP' =>$categoryP,
            'categoryC' =>$categoryC,
        ]);
    }
}
