<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(){

        $tags = Tag::latest()->get();
        return view('admin.tag.index' , compact('tags'));
    }

    public function create(){

        return view('admin.tag.create');
    }
    public function storeTag(Request $request){

        $request->validate([

            'tag_name' => 'required|string'

        ]);

        Tag::create([

            'tag_name' => $request->tag_name

        ]);
        return redirect()->route('tag.index')->with('status' , 'Tag Added Successfully');
    }
    public function editTag($id){

        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit' , compact('tag'));
    }
    
    public function updateTag(Request $request , $id){

        $request->validate([

            'tag_name' => 'required|string'

        ]);

        $tag = Tag::findOrFail($id);
        $tag->update([

            'tag_name' => $request->tag_name

        ]);
        return redirect()->route('tag.index')->with('status' , 'Tag Updated Successfully');

    }
    public function deleteTag($id){

        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('tag.index')->with('status' , 'Tag Deleted Successfully');


    }
}
