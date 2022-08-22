<?php

namespace App\Http\Controllers;

use App\Models\InstaReel;
use Illuminate\Http\Request;

class InstaReelController extends Controller
{
    public function index(Request $request)
    {
        $post = new InstaReel();
        $post->title = $request->title;
        $post->click = $request->click;
        $post->reel = $request->reel;
        $post->user_id = $request->user_id;
        $post->save();
      
        return view('insta-reels',compact('post'));
    }
    public function update(Request $request,$id)
    {
        $post= InstaReel::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $request->title,
                'click' => $request->click,
                'reel' => $request->reel,
            ],
        );
       return view('insta-reels',compact('post'));
    }
}
