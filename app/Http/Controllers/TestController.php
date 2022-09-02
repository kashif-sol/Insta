<?php

namespace App\Http\Controllers;

use App\Models\InstaFeed;
use App\Models\Instagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    public function view_feeds()
    {
        $user = Instagram::where('user_id',1)->first();
        $data = InstaFeed::where('user_id',1)->first(); 
        $id=Auth::user()->id;
        $helper = new HelperController;
        $pictures = $helper->test($user->username,$id);
        dd($pictures);
        return view('insta-feed', compact('data', 'pictures','user'));
    }
}
