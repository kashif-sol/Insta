<?php

namespace App\Http\Controllers;

use App\Models\CustomHighlight;
use App\Models\StoriesImages;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function create(Request $request)
    {
      
        
       
        $storeDet =  new Story();
        $storeDet->title = $request['title'];
        $storeDet->color_type = $request['color_type'];
        $storeDet->first_color = $request['first_color'];
        $storeDet->second_color = $request['second_color'];
        $storeDet->angle = $request['angle'];
        $storeDet->user_id = $request['user_id'];
        $storeDet->save();
        $story_id = $storeDet->id;
        if($request->hasFile('photos'))
        {
            $files = $request->file('photos');
            // dd($files);
            foreach($files as  $key => $file)
            {
               
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo( $filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $file->move(public_path().'/photos/', $fileNameToStore);
                $link = $request->story_link[$key];
                // $image_title = $request->image_title[$key];
                $path = "/photos/".$fileNameToStore;
                StoriesImages::create([
                    'story_id' => $story_id,
                   
                    'image_path' => $path,
                    'image_link' => $link
                ]);

            }
        }
        dd('txt');
        return Redirect::tokenRedirect('all-stories', ['notice' => 'Congratulations ! Your Insta story header has been saved']);
    

    }

}
