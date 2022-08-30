<?php

namespace App\Http\Controllers;

use App\Models\InstaFeed;
use App\Models\Instagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InstaFeedController extends Controller
{
    public function view_feeds()
{
    $user = Instagram::where('user_id',1)->first();
    $data = InstaFeed::where('user_id',1)->first(); 
    $helper = new HelperController;
    $pictures = $helper->insta_feeds($user->username);
    return view('insta-feed', compact('data', 'pictures','user'));
}
    public function index(Request $request)
    {
        
        if(empty($request->id))
            $post = new InstaFeed();
        else
            $post = InstaFeed::find($request->id);
       
        if(empty($request->load_more))
            $request->load_more = 0;
        $post->title = $request->title;
        $post->layout = $request->layout;
        $post->spacing = $request->spacing;
        $post->click = $request->click;
        $post->border = $request->border;
        $post->column = $request->column;
        $post->load_more = $request->load_more;
        $post->user_id = 1;
        $post->save();
    
        return Redirect::tokenRedirect('insta-feed-show', ['notice' => 'Congratulations ! Your Feeds has been saved']);
         
    }

}
