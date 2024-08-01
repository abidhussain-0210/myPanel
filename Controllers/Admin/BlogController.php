<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->simplePaginate(5);
        return view('admin.blog.index' , compact('blogs'));
    }

    public function create(){
        $categories = Category::get();
        $tags = Tag::get();
        return view('admin.blog.create' , compact('categories' , 'tags'));
    }

    public function storeBlog(Request $request){

        $request->validate([

            'blog_name' => 'required|string|max:255',
            'category_id' => 'required',
            'tag_id' => 'required',
            'description' => 'required|string',
            'image' => 'required'

        ]);

        $fileName = null;
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
        }

        Blog::create([

            'blog_name' => $request->blog_name,
            'category_id' => $request->category_id,
            'tag_id' => $request->tag_id,
            'description' => $request->description,
            'image' => $fileName,
            'status' => '1'

        ]);

        return redirect()->route('blog.index')->with('status' , 'Blog Added Successfully');

    }
}
