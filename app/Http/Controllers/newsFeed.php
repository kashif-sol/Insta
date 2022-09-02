<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use Session;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Instagram\Auth\Checkpoint\ImapClient;
use Psr\Cache\CacheException;

class newsFeed extends Controller
{
    public function dashboard()
    {    $shop = Auth::user();
        $shop_id = $shop->id;
        $user = Instagram::where('user_id' , $shop_id)->first();
        return view('dashboard',compact('user'));
    }

    public function delete_insta()
    {
        $shop = Auth::user();
        $shop_id = $shop->id;
        Instagram::where('user_id' , $shop_id)->delete();
       return Redirect::tokenRedirect('dashboard', ['notice' => 'Your account has been disconnected.']);
    }

    public function instaFeeds(Request $request)
    {
        $shop = Auth::user();
        $shop_id = $shop->id;
        $credentials = include_once realpath(dirname(__FILE__)) . '/credentials.php';
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {

            $helper = new HelperController;
            $api = new Api($cachePool);
            $imapClient = new ImapClient($credentials->getImapServer(), $credentials->getImapLogin(), $credentials->getImapPassword());
            $api->login($credentials->getLogin(), $credentials->getPassword(), $imapClient);            $username=$request->profile;
            $profile = $api->getProfile($username);
            $fullname = $profile->getFullName();
            $user = $profile->getUserName();
           
        
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }
       
       
        $user_id = $shop_id;
        $store = Instagram::firstOrNew(array('user_id' =>  $user_id));
        $store->user_id=$shop_id;
        $store->username = $request->profile;
        $store->user_fullname = $fullname;
        $store->save();
        return Redirect::tokenRedirect('dashboard', ['notice' => 'Your account has been connected.']);
        return redirect()->back();
    }
    
}
