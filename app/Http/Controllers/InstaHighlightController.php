<?php

namespace App\Http\Controllers;

use App\Models\InstaHighlight;
use Illuminate\Http\Request;

class InstaHighlightController extends Controller
{
    public function index(Request $request)
    {
        $post = new InstaHighlight();
        $post->title = $request->title;
        $post->click = $request->click;
        $post->highlight = $request->highlight;
        $post->user_id = $request->user_id;
        $post->save();
      
        return view('insta-highlights',compact('post'));
    }
    public function update(Request $request,$id)
    {
        $post= InstaHighlight::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $request->title,
                'click' => $request->click,
                'highlight' => $request->highlight,
            ],
        );
       return view('insta-highlights',compact('post'));
    }
}
