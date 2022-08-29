<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use Session;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;
use Illuminate\Support\Facades\Auth;

use Psr\Cache\CacheException;

class newsFeed extends Controller
{
    public function dashboard()
    {    $shop = Auth::user();
        $shop_id = $shop->id;
        $user = Instagram::where('user_id' , $shop_id)->first();
        // dd($user);
        return view('dashboard',compact('user'));
    }
    public function instaFeeds(Request $request)
    {
        $shop = Auth::user();
        $shop_id = $shop->id;
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {

            $helper = new HelperController;
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            $username=$request->profile;
            $profile = $api->getProfile($username);
            $fullname = $profile->getFullName();
            $user = $profile->getUserName();
           
        
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }

        $store = new Instagram();
        $store->user_id=$shop_id;
        $store->username = $user;
      
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
