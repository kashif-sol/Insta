<?php

namespace App\Http\Controllers;


use App\Models\Instagram;
use Session;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;
use Instagram\Model\Media;
use Instagram\Utils\MediaDownloadHelper;
use App\Models\InstaStory;
use App\Models\InstaFeed;
use Psr\Cache\CacheException;

class InstaStoryController extends Controller
{
    public function view_story(){
        $user = Instagram::where('user_id',1)->first();
        $data = InstaStory::where('user_id',1)->first(); 
        $helper = new HelperController;
        $feedStories = $helper->insta_stories($user->username);
        $stories = [];
        $pictures = [];
       if(!empty($feedStories))
            $stories = $feedStories->getStories();
        foreach ($stories as $story) {
            $pic = $stories->getDisplayUrl();
            $url = $pic;
            $downloadDir = public_path() . "/assets";
            $fileName = MediaDownloadHelper::downloadMedia($url, $downloadDir);
            array_push($pictures, $fileName);
        }
        $story = $pictures;
        return view('insta-stories', compact('data', 'story','user'));
    }

    public function index(Request $request)
    {
        if(empty($request->id))
            $post = new InstaStory();
        else
            $post = InstaStory::find($request->id);

        $post->title = $request->title;
        $post->click = $request->click;
        $post->story = $request->story;
        $post->user_id = 1;
        $post->save();
        return redirect('insta-story-show');
    }


}
