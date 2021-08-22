<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;


class BrandController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('checkpermission');
	}

	public function indexBrand(Request $request) {
		// $brandList = Brand::where([
		//     ['is_deleted', '=', '0'],
		// ])->get();

		$brandList = DB::table('brands')-> where('is_deleted', 0) -> paginate(10);

		return view('admin.brand.index')->with([
			'brandList' => $brandList,
		]);	
	}

	public function createBrand(Request $request) {
		return view('admin.brand.create');
	}


	public function storeBrand(Request $request) {
	$validatedData = $request->validate([
		'name' => 'required|unique:categories|min:2|max:150'
		
	], [
		'name.unique' => 'Tên thương hiệu đã tồn tại',
		'name.required' => 'Bạn chưa nhập tên thương hiệu',
		'name.min' => 'Tên thương hiệu phải tối thiểu có 2 ký tự',
		'name.max' => 'Tên thương hiệu phải tối đa có 150 ký tự',
	]);

	$brand = new Brand;
	$brand->name = $request->name;
	$brand->created_at = date('Y-m-d H:i:s');
	$brand->is_deleted = 0;
	$brand->save();

	return redirect()->route('brand_create') -> with([
		'message' => "Đã Thêm Thành Công Danh Mục Mới",
	]);
	}

	public function editBrand(Request $request, $id){
		$brand = Brand::find($id);
		return view('admin.brand.edit')->with([
			'brand' => $brand,
		]);
	}

	public function updateBrand(Request $request, $id) {
		$validatedData = $request->validate([
			'name' => 'required|unique:categories|min:2|max:150'
			
		], [
			'name.required' => 'Bạn chưa nhập tên thương hiệu',
			'name.unique' => 'Tên thương hiệu đã tồn tại',
			'name.min' => 'Tên thương hiệu phải tối thiểu có 2 ký tự',
			'name.max' => 'Tên thương hiệu phải tối đa có 150 ký tự',
		]);

		$brand = brand::find($id);
		$brand->name = $request->name;
		$brand->updated_at = date('Y-m-d H:i:s');
		$brand->save();
    	return redirect()->route('brand_edit',['id' => $id]) ->with([
    		'message' => 'Đã sửa thương hiệu sản phẩm thành công',
    	]);
	}	

		public function deleteBrand(Request $request){
			$id = $request->id;
			$brand = Brand::find($id);
			$brand->is_deleted = 1;
			$brand->save();

			$res = [
          			'message' => 'Đã xóa danh mục sản phẩm thành công',
          	 ];

			return json_encode($res);
		}









}
