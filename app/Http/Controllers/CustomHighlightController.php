<?php

namespace App\Http\Controllers;

use App\Models\CustomHighlight;
use Illuminate\Http\Request;

class CustomHighlightController extends Controller
{
    public function index(Request $request)
    {
        // $post = new CustomHighlight();
        // $post->title = $request->title;
        // $post->color = $request->color;
        // $post->image = $request->image;
        // $post->link = $request->link;
        // $post->user_id = $request->user_id;
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    
           ]);
           $post = new CustomHighlight();

           $name = $request->file('image')->getClientOriginalName();
    
           $path = $request->image->store('public/image');    
    
    
           $post->image = $name;
           $post->path = $path;
            $post->title = $request->title;
            $post->color = $request->color;
            $post->link = $request->link;
            $post->user_id = $request->user_id;

    
           $post->save();
      
        return view('custom-highlights',compact('post'));
    }
    public function update(Request $request,$id)
    {   
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    
           ]);         
        $name = $request->file('image')->getClientOriginalName();
    
        $path = $request->image->store('public/image');    
 
 
        // $post->image = $name;
        // $post->path = $path;

        $post= CustomHighlight::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $request->title,
                'color' => $request->color,
                'image' => $name,
                'path' => $path,
                'link' => $request->link,
            ],
        );
       return view('custom-highlights',compact('post'));
    }
}
