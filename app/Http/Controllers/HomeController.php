<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect() {
        $products = Product::orderBy('created_at', 'desc')->paginate(6);
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            return view('admin.home', compact('products'));
        } else {
            return view('home.userpage', compact('products'));
        }
    }

    public function index() {
        $products = Product::orderBy('created_at', 'desc')->paginate(6);
        return view('home.userpage', compact('products'));
    }

    public function product_details(Product $product) {
        return view('home.product_details', compact('product'));
    }

    public function add_to_cart(Product $product) {
        if (!Auth::id()) {
            return redirect('login');
        } else {
            $auth_user = Auth::user();

            // Provjerava da li korisnik već ima proizvod u korpi
            $existing_cart_item = Cart::where('user_id', $auth_user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existing_cart_item) {
                // Ako postoji, samo povećaj količinu
                $existing_cart_item->quantity += 1;
                $existing_cart_item->save();
            } else {
                // Ako ne postoji, kreiraj novi zapis
                Cart::create([
                    'product_id' => $product->id,
                    'user_id' => $auth_user->id,
                    'quantity' => 1,
                ]);
            }
            return redirect()->back();
        }
    }
    public function show_cart(){
        if (!Auth::id()) {
            return redirect('login');
        } else {

            $auth_user = Auth::user();

            $carts = Cart::where('user_id', $auth_user->id)->get();
            return view('home.show_cart', compact('carts'));
        }

    }
    public function delete_cart(Cart $cart){
        if($cart){
            $cart->delete();
            return redirect()->back();
        }
        else{
            abort(403,'Cart id  does not exist');
        }
    }



}
