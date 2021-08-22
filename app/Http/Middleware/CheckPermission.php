<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

use DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        $role_id = Auth::user()->role_id;
        $route_name = Route::currentRouteName();

        $routeList = DB::table('routes') -> where('name',$route_name) ->get();

        if ($routeList != null && count($routeList) > 0) {
            $route_id = $routeList[0]->id;

            $permissionList = DB::table('permissions') -> where([
                ['role_id',$role_id], 
                ['route_id',$route_id], 
            ]) ->get();

            if ($permissionList != null && count($permissionList) > 0) {
             $status = $permissionList[0]->status;
             if ($status == 1) {
                 return $next($request);
             }else {
                 // return redirect()->route('home');
                return Redirect::back()->withErrors(['Bạn Không Được Thực Hiện Hành Động Sửa Hoặc Thêm Mới']);
             }
            }else {

                // return redirect()->route('home');
                return Redirect::back()->withErrors(['Bạn Không Được Thực Hiện Hành Động Sửa Hoặc Thêm Mới']);
            }
     }
         return $next($request);
 }
}
