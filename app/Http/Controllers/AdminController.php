<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\MyFirstNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\ImageManager;
use App\Notifications;

class AdminController extends Controller
{
    public function view_category(){
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.category',compact('categories'));
    }
    public function resolve_category(Request $request){
        $request->validate(['category_name' => 'required|string|max:255']);
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->save();
        return redirect()->back()->with('message', 'Category created successfully!');
    }
    public function destroy(Category $category)
    {
        if ($category) {
            $category->delete();
            return redirect()->back()->with('message', 'Category deleted successfully.');
        }

        return redirect()->back()->with('error', 'Category not found.');
    }
    public function view_product(){
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.product',compact('categories'));
    }
    public function show_product(){
        $products = Product::all();
        return view('admin.show_product',compact('products'));
    }
    public function destroy_product(Product $product){
        if($product){
            $product->delete();
            return redirect()->back()->with('message', 'Product deleted successfully.');
        }

    }
    public function add_product(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'product_price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = $request->file('image')->store('products', 'public'); // driver is storage /products/img
        $image = ImageManager::imagick()->read("storage/{$imagePath}"); //already in public so
        $image->resize(1200, 800);
        $image->save();

        // Kreiranje proizvoda u bazi
        Product::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'price' => $validatedData['product_price'],
            'discount_price' => $validatedData['discount_price'],
            'quantity' => $validatedData['quantity'],
            'category_id' => $validatedData['category_id'],
            'image' => $imagePath,
        ]);

        // Povratak nazad sa porukom
        return redirect()->back()->with('message', 'Product added successfully.');

    }
    public function edit(Product $product){
        $categories = Category::all();
        return view('admin.edit',compact('product','categories'));

    }
    public function update(Product $product, Request $request)
    {
        // Validacija ulaza
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Koristi category_id umjesto category
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validacija slike
        ]);

        // Ažuriranje podataka proizvoda
        $product->update([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'price' => $validateData['price'],
            'discount_price' => $validateData['discount_price'],
            'quantity' => $validateData['quantity'],
            'category_id' => $validateData['category_id'], // Promijenjeno na category_id
            // Obrada slike
            'image' => $request->hasFile('image') ? $request->file('image')->store('public/images') : $product->image, // Ako postoji nova slika, pohrani je
        ]);

        return redirect()->route('show.product')->with('message', 'Product updated successfully.');
    }

    public function orders(){

        $orders = Order::all();

        return view('admin.orders',compact('orders'));
    }
    public function delete_order(Order $order){
        if($order){
            $order->delete();
        }
        return redirect()->back();
    }
    public function edit_order(Order $order){
        return view('admin.edit_order',compact('order'));
    }
    public function update_order(Request $request, Order $order)
    {
        $order_status = $request->order_status;

        if ($request->postpended === 'Yes') {
            $order_status = 'Cancelled';
        } elseif ($request->payment_status === 'Paid' && $request->delivered === 'Yes') {
            $order_status = 'Completed';
        } elseif ($request->payment_status === 'Unpaid' || $request->delivered === 'No') {
            $order_status = 'Processing';
        }

        $order->update([
            'status' => $order_status,
            'payment_status' => $request->payment_status,
            'delivered' => $request->delivered
        ]);

        return redirect('/orders');
    }
    public function all_orders_delete(){

        $status1 = 'Completed';
        $status2 = 'Cancelled';

        $orders = Order::whereIn('status',[$status1,$status2])->get();
        foreach ($orders as $order){
            $order->delete();
        }

        return redirect()->back();

    }
    public function accept_order(Order $order)
    {
        $order->update([
            'status' => 'Processing'
        ]);
        $user = $order->user;

        $details = [
            'greeting' => 'WE ACCEPT YOUR ORDER',
            'firstline' => 'Order id:#' . ''. $order->id,
            'body' => 'Thank you,'. ' ' . $order->user->name,
            'lastline' => 'Stay tuned!'
        ];

        if ($user) {
            $user->notify(new MyFirstNotification($details));
        }

        return redirect()->back();
    }

    public function download_pdf(Order $order)
    {
        $pdf = Pdf::loadView('admin.pdf_file', compact('order'));
        $pdfPath = public_path('pdfs/order_' . $order->id . '.pdf');
        $pdf->save($pdfPath);
        return redirect('/pdfs/order_' . $order->id . '.pdf');

    }





}
