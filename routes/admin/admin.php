<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;

use Illuminate\Support\Facades\Auth;

Route::group(['prefix' => 'admin'], function () {

//Category
	Route::group(['prefix' => 'category'], function () {

		Route::get('/index', [CategoryController::class , 'indexCategory'])->name('category_index');

		Route::get('/create', [CategoryController::class , 'createCategory'])->name('category_create');

		Route::post('/store', [CategoryController::class , 'storeCategory'])->name('category_store');
		
		Route::get('/edit/{id}', [CategoryController::class , 'editCategory'])->name('category_edit');

		Route::post('/update/{id}', [CategoryController::class , 'updateCategory'])->name('category_update');
		
		Route::post('/delete', [CategoryController::class , 'deleteCategory'])->name('category_delete');
	});

//Brand

	Route::group(['prefix' => 'brand'], function () {

		Route::get('/index', [BrandController::class , 'indexBrand'])->name('brand_index');

		Route::get('/create', [BrandController::class , 'createBrand'])->name('brand_create');

		Route::post('/store', [BrandController::class , 'storeBrand'])->name('brand_store');
		
		Route::get('/edit/{id}', [BrandController::class , 'editBrand'])->name('brand_edit');

		Route::post('/update/{id}', [BrandController::class , 'updateBrand'])->name('brand_update');
		
		Route::post('/delete', [BrandController::class , 'deleteBrand'])->name('brand_delete');
	});

// News
	Route::group(['prefix' => 'news'], function () {

		Route::get('/index', [NewsController::class , 'indexNews'])->name('news_index');

		Route::get('/create', [NewsController::class , 'createNews'])->name('news_create');

		Route::post('/sendfile', [NewsController::class ,'sendFile'])->name('news_sendfile');

		Route::post('/store', [NewsController::class , 'storeNews'])->name('news_store');

		Route::get('/edit/{id}', [NewsController::class , 'editNews'])->name('news_edit');

		Route::post('/update/{id}', [NewsController::class , 'updateNews'])->name('news_update');

		Route::post('/delete', [NewsController::class , 'deleteNews'])->name('news_delete');
	});

// Product
	Route::group(['prefix' => 'product'], function () {

		Route::get('/index', [ProductController::class , 'indexProduct'])->name('product_index');

		Route::get('/create', [ProductController::class , 'createProduct'])->name('product_create');

		Route::post('/getCategoryChild', [ProductController::class ,'getCategoryChild'])->name('get_category_child');

		Route::post('/sendfile', [ProductController::class ,'sendFile'])->name('product_sendfile');

		Route::post('/store', [ProductController::class , 'storeProduct'])->name('product_store');

		Route::get('/edit/{id}', [ProductController::class , 'editProduct'])->name('product_edit');

		Route::post('/update/{id}', [ProductController::class , 'updateProduct'])->name('product_update');

		Route::post('/delete', [ProductController::class , 'deleteProduct'])->name('product_delete');
	});	


	// Product Thumnail
	// Route::group(['prefix' => 'productthumnails'], function () {

	// 	Route::get('/index', [NewsController::class , 'indexNews'])->name('news_index');

	// 	Route::get('/create', [NewsController::class , 'createThumnail'])->name('news_create');

	// 	Route::post('/sendfile', [NewsController::class ,'sendFile'])->name('news_sendfile');

	// 	Route::post('/store', [NewsController::class , 'storeNews'])->name('news_store');

	// 	Route::get('/edit/{id}', [NewsController::class , 'editNews'])->name('news_edit');

	// 	Route::post('/update/{id}', [NewsController::class , 'updateNews'])->name('news_update');

	// 	Route::post('/delete', [NewsController::class , 'deleteNews'])->name('news_delete');
	// });

	// Order
	Route::resource('order', OrderController::class)-> only(['index','show','destroy']);

	//Thay doi trang thai don hang
	Route::group(['prefix' => 'order'], function () {
		Route::post('/update', [OrderController::class , 'updateOrderStatus'])->name('order_update');
	});

	//Hien thi don hang dang chờ duyet
	Route::group(['prefix' => 'orderpending'], function () {
		Route::get('/index', [OrderController::class , 'pendingOrder'])->name('order_pending');
	});

	//Xử lý xác nhận đơn hàng
	Route::group(['prefix' => 'orderpending'], function () {
		Route::get('/confirm/{id}', [OrderController::class , 'confirmOrder'])->name('order_confirm');
	});


	//Sale
	Route::group(['prefix' => 'sale'], function () {
		Route::get('/index', [SaleController::class , 'indexSale'])->name('sale_index');
	});

	//Permission
		//Xử lý xác nhận đơn hàng
	//Hiện thị danh sách các Role
	Route::group(['prefix' => 'permission'], function () {
	   Route::get('/indexroles', [PermissionController::class , 'indexRoles'])->name('roles_index');

	   //Hien thi bang Setting tung Role voi cac Route
	   Route::get('/rolesetting/{id}', [PermissionController::class , 'settingRole'])->name('rolesetting');

	   //Update trang thai Kich hoat hay khong kich hoat  trong bang setting
	   Route::post('/update_permisson', [PermissionController::class , 'updatePermisson'])->name('update_permisson');
	});


	//User
	Route::group(['prefix' => 'user'], function () {
	   Route::get('/indexusers', [UserController::class , 'indexUsers'])->name('users_index');

	   //Thay đổi Role cho user
	   Route::post('/updaterole', [UserController::class , 'updateRole'])->name('role_update');

	   //Xóa tài khoản người dùng
	   Route::post('/deleteuser', [UserController::class , 'deleteUser'])->name('users_delete');
	});

});





