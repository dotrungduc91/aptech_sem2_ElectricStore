<?php 
if (!function_exists('checkAvaiableRoute')) {
	function checkAvaiableRoute($routeName){
		$role_id = Illuminate\Support\Facades\Auth::user()->role_id;
        //Lay route name tu link
        $route     = \DB::table('routes')
            ->where('name', $routeName)
            ->get();
        // echo $routeName;
        if ($route != null && count($route) > 0) {
            $route_id = $route[0]->id;
            // echo $route_id;

            $permission = \DB::table('permissions')
                ->where('route_id', $route_id)
                ->where('role_id', $role_id)
                ->get();
            // echo $route_id.'-'.$role_id;
            // var_dump($permission);
            if ($permission != null && count($permission) > 0) {
                if ($permission[0]->status == 0) {
                    return false;
                }
            } else {
                return false;
            }
        }
        return true;
	}
}