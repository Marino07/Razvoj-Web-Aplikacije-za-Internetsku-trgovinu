<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
        $products = Product::paginate(6);
        $usertype = Auth::user()->usertype;
        if($usertype == '1'){
            return view('admin.home',compact('products'));
        }
        else{
            return view('home.userpage',compact('products'));
        }
    }
    public function index(){
        $products = Product::paginate(6);
        return view('home.userpage',compact('products'));
    }
    public function product_details(Product $product){

        return view('home.product_details',compact('product'));
    }

}
