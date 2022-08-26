<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use Session;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;

use Psr\Cache\CacheException;

class newsFeed extends Controller
{
    public function dashboard()
    {   
        $user = Instagram::where('user_id','4284451936')->first();
        // dd($user);
        return view('dashboard',compact('user'));
    }
    public function instaFeeds(Request $request)
    {
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {

            $helper = new HelperController;
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            $username=$request->profile;
            $profile = $api->getProfile($username);
            $fullname = $profile->getFullName();
            $id=$profile->getId();
        
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }

        $store = new Instagram();
        $store->user_id=$id;
        $store->username = $fullname;
      
        $store->user_fullname = $fullname;
        $store->save();
        return redirect()->back();
    }
    public function Test(Request $request)
    {
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {

            $helper = new HelperController;
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            // $profiles = $request->profile;
            // $profile = $api->getProfile($profiles);
            $profile = $api->getProfile('kmushtaq7');
            $fullname = $profile->getFullName();
            $stories = $helper->stories($profile, $api);
            $reels = $helper->reels($profile, $api);
            $feeds = $helper->media($profile, $api);
            dump(['stories' => $stories]);
            dump(['reels' => $reels]);
            dump(['feeds' => $feeds]);
            dump(['fullname' => $fullname]);
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }
    }
}
