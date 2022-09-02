<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use App\Models\InstaReel;
use Illuminate\Http\Request;
use Instagram\Utils\MediaDownloadHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class InstaReelController extends Controller
{
    public function view_reel()
    {
        // $shop = Auth::user();
        $shop_id = 1;

        $user = Instagram::where('user_id',$shop_id)->first();
        $tab = InstaReel::where('user_id', $shop_id)->first();
        $reel_data = [];
        $helper = new HelperController;
         $reelsFeed = $helper->insta_reels($user->username);
        if(!empty($reelsFeed))
        {
            foreach ($reelsFeed->getReels() as $reels) {
               
                $data = $reels->getVideos()[0]->url;
                $link = $reels->getLink();
                $url = $data;
                $downloadDir = public_path() . "/reels";
                $fileName = MediaDownloadHelper::downloadMedia($url, $downloadDir);
                $reel_data[] = array(
                    "link" => $link,
                    "file" => $fileName
                );
            }
        }
        
        return view('insta-reels', compact('tab', 'reel_data', 'user'));
    }
    public function index(Request $request)
    {
        // $shop = Auth::user();
        $shop_id = 1;

        if(empty($request->id))
            $post = new InstaReel();
        else
            $post = InstaReel::find($request->id);

        $post->title = $request->title;
        $post->click = $request->click;
        $post->reel = "A";
        $post->user_id = $shop_id;
        $post->save();
        return Redirect::tokenRedirect('insta-reel-show', ['notice' => 'Congratulations ! Your Feeds has been saved']);
    }
    
}
