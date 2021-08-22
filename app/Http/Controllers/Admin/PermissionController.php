<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class PermissionController extends Controller{ 

    public function __construct() {
    $this->middleware('auth');
    $this->middleware('checkpermission');
    }


    public function indexRoles(Request $request)
    { 
      $roleList = DB::table('roles') ->paginate(10);
      return view('admin.permission.indexroles')->with([
      'roleList' => $roleList,
      'count' => 0,
    ]);
    }


      //Hiển thị view cài đặt tửng Role
        public function settingRole(Request $request, $id) {  
      $permissionList = DB::table('permissions') -> where('role_id', $id) ->get();

      $routeList = DB::table('routes') 
      ->orderBy('name', 'asc')
      ->get();

      $list = [];

      foreach ($routeList as $route) {
        $status = 0; //Mặc định 0 là trạng thái chưa kích hoạt
        foreach ($permissionList as $item) {
          if($item->route_id == $route->id) {
            $status = $item->status;
            break;
                 }
          }
          $list[] = [
            'route_id' => $route ->id,
            'route_name' => $route ->name,
            'route_title' => $route ->title,
            'status' => $status
        ];
    }

      return view('admin.permission.indexsettingrole')->with([
      'list' => $list,
      'role_id' => $id,
      'count' => 0,
    ]);
    }


    public function updatePermisson(Request $request){
        $role_id = $request->role_id;
        $route_id = $request->route_id;
        $status = $request->status;

        $permissionList = DB::table('permissions') -> where([
            ['role_id', $role_id],
            ['route_id', $route_id],
        ]) ->get();

        if (count($permissionList) == 1 ) {
          $permissionList = DB::table('permissions') -> where([
              ['role_id', $role_id],
              ['route_id', $route_id],
          ]) ->update([
            'status' => $status,
        ]);
      }else{
         DB::table('permissions') -> insert([
            'role_id' => $role_id,
            'route_id' => $route_id,
            'status' => $status
        ]);
     }
     return "Thay Đổi Trạng Thái Thành Công";
  }
}
