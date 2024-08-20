<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe;

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
    public function all_products(){
        $products = Product::all();
        return view('home.view_all_products',compact('products'));
    }

    public function product_details(Product $product) {
        return view('home.product_details', compact('product'));
    }

    public function add_to_cart(Product $product) {
        if (!Auth::id()) {
            return redirect('login');
        } else {
            $auth_user = Auth::user();

            $existing_cart_item = Cart::where('user_id', $auth_user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existing_cart_item) {
                $existing_cart_item->quantity += 1;
                $existing_cart_item->save();
            } else {
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
    public function cashpay($total_price)
    {
        if ($total_price <= 0) {
            return redirect()->back()->with('error', 'Invalid total price.');
        }

        $user = Auth::id();

        $order = Order::create([
            'user_id' => $user,
            'total_amount' => $total_price,
            'payment_method' => 'cash',
        ]);

        $cartItems = Cart::where('user_id', $user)->get();

        foreach ($cartItems as $item) {
            $price = $item->product->discount_price ? $item->product->discount_price : $item->product->price;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $price
            ]);
        }

        Cart::where('user_id', $user)->delete();

        return redirect()->back()->with('message', 'Thank you for your order!');
    }

    public function stripe($total_price){
       return view('home.stripe',compact('total_price'));
    }

    public function stripePost(Request $request,$total_price)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => $total_price * 100, // count on cents not dollars so make sure
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment"
        ]);

        $user = Auth::id();
        $order = Order::create([
            'user_id' => $user,
            'payment_method' => 'credit card',
            'total_amount' => $total_price,
            'payment_status' => 'Paid',
        ]);
        $cartItems = Cart::where('user_id', $user)->get();


        foreach ($cartItems as $item) {
            $price = $item->product->discount_price ? $item->product->discount_price : $item->product->price;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $price
            ]);
        }
        Cart::where('user_id',$user)->delete();

        return redirect('/show_cart')->with('message','Thanks for your order');
    }
    public function show_orders(){
        $user = Auth::id();
        $orders = Order::where('user_id',$user)->get();
        return view('home.show_orders',compact('orders'));
    }
    public function cancel_order(Order $order){
        $order->update([
           'status' => 'Cancelled'
        ]);
        return redirect()->back();
    }



}
