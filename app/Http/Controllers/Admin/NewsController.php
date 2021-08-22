<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\News;
use DB;
class NewsController extends Controller
{	
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('checkpermission');
	}

	//Đổ ra Form Tạo Tin Tức mới
	public function createNews(Request $request) {
		return view('admin.news.create');
	}


	//AJAX- Upoad ảnh vào folder khi thả ảnh vào khung summernote, trả về đường link ảnh
	public function sendFile(Request $request) {

		// if ($_FILES['file']['name']) {
		//   if (!$_FILES['file']['error']) {
		//     $name = md5(rand(100, 200));
		//     $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		//     $filename = $name.
		//     '.'.$ext;
		//     $destination = '/assets/images/'.$filename; 
		//     $location = $_FILES["file"]["tmp_name"];
		//     move_uploaded_file($location, $destination);
		//     echo 'http://test.yourdomain.al/images/'.$filename; 
		//   } else {
		//     echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
		//   }
		// }

		if ($request->hasFile('file')) {  

			$file = $request->file('file');  

			$typefile = $file->getClientOriginalExtension();

			if ($typefile == 'jpg' || $typefile == 'png' || $typefile == 'jpeg') {

                $filename = time().'_'.$file->getClientOriginalName(); //Dat  lai ten cho file

                while (file_exists($filename)) {
					$filename = time().'_'.$file->getClientOriginalName();
				}

          		$file->move('project/images/news/details/',$filename); //move file ve thu muc 
          		$res = [
          			'url'=> "project/images/news/details/".$filename,
          			'message' => 'success',
          		];
     		}else{
      		$res = [
          			'url'=> null,
          			'message' => 'Chọn lại file ảnh định dạng jpg, png, jpeg',
          		  ];
     		 }

      	return json_encode($res);
  		}
	}

	//Lưu Tin tức mới vào Database
	public function storeNews(Request $request) {
		$validatedNews = $request->validate([
    		'title' => 'required|unique:news|min:5',
    		'thumnail'  => 'required',
    		'short_content' => 'required|unique:news|min:20',
    		'content' => 'required|unique:news|min:100',
		], [
			'title.required' => 'Bạn chưa nhập tiêu đề bài viết',
			'title.unique' => 'Tiêu đề bài viết đã tồn tại',
			'title.min' => 'Tiêu đề bài viết phải tối thiểu có 5 ký tự',

			'thumnail.required' => 'Bạn chưa chọn hình ảnh minh họa bài viết',

			'short_content.required' => 'Bạn chưa nhập tóm tắt nội dung bài viết',
			'short_content.unique' => 'Nội dung tóm tắt bài viết đã tồn tại',
			'short_content.min' => 'Nội dung tóm tắt bài viết bài viết phải tối thiểu có 20 ký tự',

			'content.required' => 'Bạn chưa nhập nội dung bài viết',
			'content.unique' => 'Nội dung bài viết đã tồn tại',
			'content.min' => 'Nội dung bài viết bài viết phải tối thiểu có 100 ký tự',
		]);

		if ($request->hasFile('thumnail')) {
			$thumnail = $request->file('thumnail');

			$type = $thumnail->getClientOriginalExtension();

			if ($type == 'jpg' || $type == 'png' || $type == 'jpeg') {

                $thumnail_name = time().'_'. $thumnail->getClientOriginalName(); 
                while (file_exists($thumnail_name)) {
					$thumnail_name = time().'_'.$thumnail->getClientOriginalName();
				}

          		$thumnail->move('project/images/news/thumnails/',$thumnail_name); 
          	
     		}else{
	 			return redirect()->route('news_create') -> with([
					'err_thumnail' => "Chọn lại ảnh minh họa bài viết định dạng jpg, png, jpeg",
				]);
     		}
  		}
	  		$news = new News;
			$news->title = $request->title;
			$news->href_param = $request->title;
			$news->thumnail = '/project/images/news/thumnails/'.$thumnail_name;
			$news->short_content = $request->short_content;
			$news->content = $request->content;
			$news->created_at = date('Y-m-d H:i:s');
			$news->updated_at = date('Y-m-d H:i:s');
			$news->save();

			return redirect()->route('news_create') -> with([
					'message' => "Đã thêm bài viết thành công",
			]);
		}

		//Đổ danh sách tin tức từ DataBase ra table dữ liệu
		public function indexNews(Request $request){
			// Danh so thu tu cho du lieu
			$numberPage = 10;  //so luong tin tuc tren 1 page

			$newsList = News::where('is_deleted', 0)->paginate($numberPage);

			$index = 0; //danh so thu tu mac dinh = 0 cho truong hop ban dau khong co page
			if (isset($request->page)) {
				$index = ($request->page - 1) * $numberPage;
			}


			 //Kiêm tra phân quyền có được xóa danh muc không
		    $delete_permission = checkAvaiableRoute('news_delete');
		    if ( $delete_permission == true) {
		    	$delete_permission = 1;
		    }else{
		    	$delete_permission = 0;
		    }

			// Danh so thu tu cho du lieu End
			return view('admin.news.index')->with([
				'newsList' => $newsList,
				'index'=> $index,
				'delete_permission'=>$delete_permission
			]);
		}


		//Đổ ra Form sửa tin tức
		public function editNews(Request $request, $id){
			$news = News::find($id);
			return view('admin.news.edit')->with([
				'news' => $news,
			]);
		}


		//Lưu nội dung tin tức trong Form sửa vào database
		public function updateNews(Request $request, $id){
			$validatedNews = $request->validate([
    		'title' => 'required|min:5',
    		'short_content' => 'required|min:20',
    		'content' => 'required|min:100',
		], [
			'title.required' => 'Bạn chưa nhập tiêu đề bài viết',
			'title.min' => 'Tiêu đề bài viết phải tối thiểu có 5 ký tự',

			'short_content.required' => 'Bạn chưa nhập tóm tắt nội dung bài viết',
			'short_content.min' => 'Nội dung tóm tắt bài viết bài viết phải tối thiểu có 20 ký tự',

			'content.required' => 'Bạn chưa nhập nội dung bài viết',
			'content.min' => 'Nội dung bài viết bài viết phải tối thiểu có 100 ký tự',
		]);

			$news = News::find($id);
			$news->title = $request->title;
			$news->href_param = $request->title;
			$news->short_content = $request->short_content;
			$news->content = $request->content;
			$news->created_at = date('Y-m-d H:i:s');
			$news->updated_at = date('Y-m-d H:i:s');
			

		if ($request->hasFile('thumnail')) {
			$thumnail = $request->file('thumnail');

			$type = $thumnail->getClientOriginalExtension();

			if ($type == 'jpg' || $type == 'png' || $type == 'jpeg') {

	            $thumnail_name = time().'_'. $thumnail->getClientOriginalName(); 

	            while (file_exists("project/images/news/thumnails/".$thumnail_name)) {
					$thumnail_name = time().'_'.$thumnail->getClientOriginalName();
				}

	      		$thumnail->move('project/images/news/thumnails/',$thumnail_name); 

				// if(file_exists($news->thumnail)){
				//    unlink($news->thumnail);
				// }

	          	$news->thumnail = '/project/images/news/thumnails/'.$thumnail_name;
  			}
			
		}
				$news->save();

				return redirect()->route('news_edit',['id'=>$news->id]) -> with([
					'message' => "Đã sửa bài viết thành công",
			]);
		}


		public function deleteNews(Request $request){
			$id = $request->id;
			$news = News::find($id);
			$news->is_deleted = 1;
			$news->save();
			
			$res = [
          			// 'newsList'=> $newsList,
          			'message' => 'Đã xóa tin tức thành công',
          	 ];

			return json_encode($res);
		}
	}

