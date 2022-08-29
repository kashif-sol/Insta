<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use App\Models\InstaReel;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;
use Instagram\Model\Media;
use Instagram\Model\ReelsFeed;
use Instagram\Utils\MediaDownloadHelper;

class InstaReelController extends Controller
{
    public function view_reel()
    {
        $user = Instagram::where('user_id',2)->first();
        $tab = InstaReel::where('user_id', 1)->first();
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

        if(empty($request->id))
            $post = new InstaReel();
        else
            $post = InstaReel::find($request->id);

        $post->title = $request->title;
        $post->click = $request->click;
        $post->reel = $request->reel;
        $post->user_id = 1;
        $post->save();
        return redirect('insta-reel-show');
    }
    
}
