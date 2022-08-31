<?php

namespace App\Http\Controllers;

use App\Models\CustomHighlight;
use App\Models\Instagram;
use App\Models\StoriesImages;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\settings;

class CustomHighlightController extends Controller
{
    

    public function view_stories()
    {
       
        $shop = Auth::user();
        $shop_id = $shop->id;
        $user = Instagram::where('user_id',$shop_id)->first();
        $data = Story::with('images')->where('user_id',$shop_id)->first(); 
        if(!isset($data)){
            return view('custom-highlights');

        }

        $images=$data->images->toArray();
        
        return view('custom-highlights',compact('data','images','user'));
    }

    

    public function delete_image($id)
    {
        StoriesImages::find($id)->delete();
        return array("status" => true , "message" => "Image deleted");
    }

    public function shop_stories(Request $request)
    {
        $shop = User::where("name", $request->shop)->first();
        $stories = Story::with("images")
        ->where("user_id" ,$shop->id)
        ->get();

        $settings = settings::where("shop_id" ,$shop->id)->first();
        return view("shopify.index",compact('settings' , 'stories'))->render();
       
    }

    public function create(Request $request)
    {
        
        
        $shop = Auth::user();
        $shop_id = $shop->id;
        $user_id = $shop_id;
         $storeDet = Story::firstOrNew(array('user_id' =>  $user_id));
        $storeDet->title = $request->title;
        $storeDet->color_type = $request->color_type;
        $storeDet->first_color = $request->first_color;
        $storeDet->second_color = $request->second_color;
        $storeDet->angle = $request->angle;
        $storeDet->user_id = $user_id;
        $storeDet->save();
        $story_id = $storeDet->id;
            
        if($request->hasFile('photos'))
        {
            $files = $request->file('photos');
           
            foreach($files as  $key => $file)
            {
               
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo( $filenameWithExt, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $file->move(public_path().'/photos/', $fileNameToStore);
                $link = $request->story_link[$key];
                $path = "/photos/".$fileNameToStore;
                StoriesImages::create([
                    'story_id' => $story_id,
                    'image_title' => "",
                    'image_path' => $path,
                    'image_link' => $link
                ]);

            }
        }
        // return Redirect::tokenRedirect('all-stories', ['notice' => 'Congratulations ! Your Insta story header has been saved']);
        return Redirect::tokenRedirect('custom-highlights-show', ['notice' => 'Congratulations ! Your Feeds has been saved']);


    }

}
