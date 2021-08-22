<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{	
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('checkpermission');
	}

	public function indexCategory(Request $request) {
		$categoryParentList = Category::where([
		    ['is_deleted', '=', '0'],
		    ['parent_id', '=', '0'],
		])->get();


		$categoryChildList = Category::where([
		    ['is_deleted', '=', '0'],
		    ['parent_id', '<>', '0'],
		])->get();

		//Kiêm tra phân quyền có được xóa danh muc không
		$delete_permission = checkAvaiableRoute('news_delete');
		if ( $delete_permission == true) {
			$delete_permission = 1;
		}else{
			$delete_permission = 0;
		}

		return view('admin.category.index')->with([
			'categoryParentList' => $categoryParentList,
			'categoryChildList' => $categoryChildList,
			'delete_permission'=>$delete_permission,
		]);	
	}

	public function createCategory(Request $request) {
		$categoryParentList = Category::where([
		    ['is_deleted', '=', '0'],
		    ['parent_id', '=', '0'],
		])->get();


		$categoryChildList = Category::where([
		    ['is_deleted', '=', '0'],
		    ['parent_id', '<>', '0'],
		])->get();

		return view('admin.category.create')->with([
			'categoryParentList' => $categoryParentList,
			'categoryChildList' => $categoryChildList,
		]);
	}

	public function storeCategory(Request $request) {
		$validatedData = $request->validate([
    		'name' => 'required|unique:categories|min:3|max:150'
			
		], [
			'name.unique' => 'Tên danh mục đã tồn tại',
			'name.required' => 'Bạn chưa nhập tên danh mục',
			'name.min' => 'Tên danh mục phải tối thiểu có 3 ký tự',
			'name.max' => 'Tên danh mục phải tối đa có 150 ký tự',
		]);

		$category = new Category;
		$category->name = $request->name;
		$category->href_param = $request->name;
		$category->parent_id = $request->parent_id;
		$category->created_at = date('Y-m-d H:i:s');
		$category->is_deleted = 0;
		$category->save();

		return redirect()->route('category_create') -> with([
			'message' => "Đã Thêm Thành Công Danh Mục Mới",
		]);
	}

	public function editCategory(Request $request, $id) {
		$category = Category::find($id);
    	return view('admin.category.edit')->with([
			'category' => $category,
		]);;
	}

	public function updateCategory(Request $request, $id) {
		$validatedData = $request->validate([
			'name' => 'required|unique:categories|min:3|max:150'
			
		], [
			'name.required' => 'Bạn chưa nhập tên danh mục',
			'name.unique' => 'Tên danh mục đã tồn tại',
			'name.min' => 'Tên danh mục phải tối thiểu có 3 ký tự',
			'name.max' => 'Tên danh mục phải tối đa có 150 ký tự',
		]);

		$category = Category::find($id);
		$category->name = $request->name;
		$category->href_param = $request->name;
		$category->save();
    	return redirect()->route('category_edit',['id' => $id]) ->with([
    		'message' => 'Đã sửa danh mục sản phẩm thành công',
    	]);
	}

	public function deleteCategory(Request $request) {
		$id = $request->id;
		$category = Category::find($id);

		$checkParentId = $category->parent_id;

		//Kiem tra neu la category cha thi xoa het cac category con cung category cha
		if($checkParentId > 0 ){
			$category->is_deleted = 1;
			$category->save();

		$productList = Product::where([
		    ['is_deleted', '=', '0'],
		    ['category_id', '=', $category->id],
		])->get();

			foreach ($productList as $product) {
				$product->is_deleted = 1;
				$product->save();
			}

		} else {

			$category->is_deleted = 1;
			$category->save();

			$categoryChildList = Category::where([
			    ['parent_id', '=', $id],
			])->get();

			foreach ($categoryChildList as $category) {
				$category->is_deleted = 1;
				$category->save();

				$productList = Product::where([
			    ['is_deleted', '=', '0'],
			    ['category_id', '=', $category->id],
			])->get();

				foreach ($productList as $product) {
				  $product->is_deleted = 1;
				  $product->save();
				}
			}
		}
		return 'Đã xóa danh mục sản phẩm thành công';
	}

}
