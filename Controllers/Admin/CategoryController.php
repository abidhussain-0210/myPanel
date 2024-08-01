<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index' , compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }
    public function storeCategory(Request $request){
        $request->validate([

            'name' => 'required|string'

        ]);
        Category::create([

            'name' => $request->name,


        ]);
        return redirect()->route('category.index')->with('status' , 'Category Added Successfully');
    }

    public function editCategory($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit' , compact('category'));
    }

    public function updateCategory(Request $request , $id){
       

        $request->validate([

            'name' => 'required|string'

        ]);

        $category = Category::findOrFail($id);
        $category->update([

            'name' => $request->name

        ]);
        return redirect()->route('category.index')->with('status' , 'Category Updated Successfully');
    }

    public function deleteCategory($id){

        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('status' , 'Category Deleted Successfully');

    }
    
}
