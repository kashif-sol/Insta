<?php

namespace App\Http\Controllers;

use App\Models\InstaStory;
use Illuminate\Http\Request;

class InstaStoryController extends Controller
{
    public function index(Request $request)
    {
        $post = new InstaStory();
        $post->title = $request->title;
        $post->click = $request->click;
        $post->story = $request->story;
        $post->user_id = $request->user_id;
        $post->save();
      
        return view('insta-stories',compact('post'));
    }
    public function update(Request $request,$id)
    {
        $post= InstaStory::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $request->title,
                'click' => $request->click,
                'story' => $request->story,
            ],
        );
       return view('insta-stories',compact('post'));
    }
}
