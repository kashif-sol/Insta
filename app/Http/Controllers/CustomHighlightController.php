<?php

namespace App\Http\Controllers;

use App\Models\CustomHighlight;
use App\Models\StoriesImages;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CustomHighlightController extends Controller
{
    

    public function view_stories()
    {
       
        //// stories
        /// images
        $data = Story::with('images')->where('user_id',2)->first(); 
       
   $images=$data->images;

   return view('custom-highlights',compact('data','images'));

    }

    
    
    public function update(Request $request,$id)
    {   
      DB::table('stories')
              ->where('id',$id )
              ->update(['title' => $request->title,
                        'color_type'=>$request->color_type,
                        'first_color'=>$request->first_color,
                        'second_color'=>$request->second_color,
                        'angle'=>$request->angle,
            ]);
            $story_id = $id;
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
            // $image= StoriesImages::create([
            //         'story_id' => $story_id,
                   
            //         'image_path' => $path,
            //         'image_link' => $link
            //     ]);
            //     $image->save();
            DB::table('stories_images')
        ->where('story_id',$id )
        ->update(['story_id'=>$id,
        'image_path' => $path,
        'image_link' => $link
                        
            ]);
           
            }
        }
        
          return redirect('custom-highlights-show');
    }

    public function create(Request $request)
    {
      
        
        $user_id = 2;
        $storeDet =  new Story();
        $storeDet->title = $request['title'];
        $storeDet->color_type = $request['color_type'];
        $storeDet->first_color = $request['first_color'];
        $storeDet->second_color = $request['second_color'];
        $storeDet->angle = $request['angle'];
        $storeDet->user_id = $user_id;
        $storeDet->save();
        $story_id = $storeDet->id;
        if($request->hasFile('photos'))
        {
            $files = $request->file('photos');
            // dd($files);
            $array=[];
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
                array_push($array,$path);
            $image= StoriesImages::create([
                    'story_id' => $story_id,
                   
                    'image_path' => $path,
                    'image_link' => $link
                ]);
                $image->save();
            }
        }
        // dd('txt');
        // return Redirect::tokenRedirect('all-stories', ['notice' => 'Congratulations ! Your Insta story header has been saved']);
    return redirect('custom-highlights-show');

    }

}
