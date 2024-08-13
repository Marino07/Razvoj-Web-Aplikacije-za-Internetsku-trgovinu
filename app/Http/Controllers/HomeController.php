<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
        $products = Product::all();
        $usertype = Auth::user()->usertype;
        if($usertype == '1'){
            return view('admin.home');
        }
        else{
            return view('home.userpage',compact('products'));
        }
    }
    public function index(){
        return view('home.userpage');
    }

}
