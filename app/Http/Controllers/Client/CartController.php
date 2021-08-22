<?php

namespace App\Http\Controllers\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(Request $request)
    {
        $num = $request->num;
        return view('test')->with([
            'num' => $num
        ]); 
    }
}
