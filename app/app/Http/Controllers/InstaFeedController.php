<?php

namespace App\Http\Controllers;

use App\Models\InstaFeed;
use App\Models\Instagram;
use Session;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;
use Instagram\Model\Media;
use Instagram\Utils\MediaDownloadHelper;


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
        
        return redirect('insta-feed-show');
    }

}
