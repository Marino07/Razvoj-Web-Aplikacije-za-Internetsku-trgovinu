<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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


}
