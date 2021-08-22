<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserController extends Controller
{	

	public function __construct() {
		$this->middleware('auth');
		$this->middleware('checkpermission');
	}
	
	public function indexUsers(Request $request)
	{	
		$roleList = DB::table('roles') ->get();

		$userList = DB::table('users') -> leftjoin('roles', 'users.role_id', '=', 'roles.id') -> select('users.*','roles.id as role_id', 'roles.name as role_name')->where('users.is_deleted', 0);

		// dd($roleList);

		if (isset($request->user_name) && $request->user_name != '' ) {
			$userList = $userList ->where('users.name', 'like', '%'.$request->user_name.'%');
		}

		$userList = $userList->paginate(10);

		$index = 0;
		if (isset($request->page)) {
			$index = ($request->page - 1) *10;
		}

		return view('admin.user.index')->with([
			'roleList' => $roleList,
			'userList' => $userList,
			'index'=> $index,
				//keep lai thong tin phan tim kiem
			'user_name' => $request->user_name,
		]);
	}

	public function updateRole(Request $request){   
		$user_id = $request->user_id;
		$user = User::find($user_id);
		$user->role_id = $request->role_id;
		$user->updated_at = date('Y-m-d H:i:s');
		$user->save();
		return 'Đã sửa thành công';
	}

	public function deleteUser(Request $request){   
		$user_id = $request->user_id;
		$user = User::find($user_id);
		$user->is_deleted = 1;
		$user->updated_at = date('Y-m-d H:i:s');
		$user->save();
		return 'Đã xóa tài khoản người dùng thành công';
	}
}
