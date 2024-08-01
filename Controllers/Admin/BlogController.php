<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use File;

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
    public function editBlog($id){
        $blog = Blog::findOrFail($id);
        $categories = Category::get();
        $tags = Tag::get();
        return view('admin.blog.edit' , compact('blog' , 'categories' , 'tags'));
    }
    public function updateBlog(Request $request , $id){
       
        // $request->validate([
        // 'blog_title' => 'required|string|max:255',
        // 'category_id' => 'required|string|max:255',
        // 'blog_tags' => 'required|string|max:255',
        // 'description' => 'required|string',
        // 'image' => 'required' // Validate the image file
        // ]);

        $blog = Blog::findOrFail($id);
        $currentImage = $blog->image;
        $fileName = null;
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
        }

        $blog->update([
            'blog_name' => $request->blog_name,
            'category_id' => $request->category_id,
            'tag_id' => $request->tag_id,
            'description' => $request->description,
            'image' => ($fileName) ? $fileName : $currentImage,
            'status' => '1'
        ]);
        if ($fileName)
         File::delete('./uploads/' . $currentImage);

        return redirect()->route('blog.index')->with('status' , 'Blog Updated Successfully');

    }

    public function statusBlog($id){
        $status = Blog::findOrFail($id);
        $newStatus = ($status->status ==  1) ? 0 : 1;
        $status->update([
            'status' => $newStatus
        ]);
        return redirect()->back()->with('status' , 'Status Updated Successfully');
    }
    public function deleteBlog($id){
        $blog = Blog::findOrFail($id);
        $currentImage = $blog->image;
        $blog->delete();
        File::delete('./uploads/' . $currentImage);
        return redirect()->route('blog.index')->with('status', 'Blog Deletd Successfully');    }
}
