<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        $post = new InstaReel();
        $post->title = $request->title;
        $post->click = $request->click;
        $post->reel = $request->reel;
        $post->user_id = $request->user_id;
        $post->save();
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {


            $helper = new HelperController;
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            $profile = $api->getProfile('kmushtaq7');
            $id=$profile->getId();
            $fullname = $profile->getFullName();
        $reelsFeed = $api->getReels($id);
        $reel_data=[];
       foreach ($reelsFeed->getReels() as $reels){
        $data=$reels->getVideos()[0]->url;
        $url = $data;
                 $downloadDir = public_path() . "/reels";
                 $fileName = MediaDownloadHelper::downloadMedia($url, $downloadDir);
       
        array_push($reel_data,$fileName);
       }
    } catch (InstagramException $e) {
        dd($e->getMessage());

    }
        return view('insta-reels',compact('post','reel_data'));
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
