<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use App\Models\InstaHighlight;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstaHighlightController extends Controller
{
    public function view_highlight()
    {  
        $shop = Auth::user();
        $shop_id = $shop->id;
        $user = Instagram::where('user_id', $shop_id)->first();
        $tab = InstaHighlight::where('user_id', $shop_id)->first();
       
        $pictures = [];
        $helper = new HelperController;
        $highlight=$helper->insta_highlights($user->username);
     
    return view('insta-highlights', compact('tab','highlight','user','pictures'));

}



    public function index(Request $request)
    {
        $shop = Auth::user();
        $shop_id = $shop->id;
        if (empty($request->id))
            $post = new InstaHighlight();
        else
            $post = InstaHighlight::find($request->id);

        $post->title = $request->title;
        $post->click = $request->click;
        $post->highlight = "A";
        $post->user_id = $shop_id;
        $post->save();
        return Redirect::tokenRedirect('insta-highlight-show', ['notice' => 'Congratulations ! Your Feeds has been saved']);
   
    }
}
