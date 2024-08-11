<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

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


}
