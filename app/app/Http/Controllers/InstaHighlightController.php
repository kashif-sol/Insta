<?php

namespace App\Http\Controllers;

use App\Models\Instagram;
use App\Models\InstaHighlight;
use Session;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;
use Instagram\Model\Media;
use Instagram\Utils\MediaDownloadHelper;

class InstaHighlightController extends Controller
{
    public function view_highlight()
    {
        $user = Instagram::where('user_id', '4284451936')->first();
        $tab = InstaHighlight::where('user_id', 2)->first();
        $pictures = [];

        if (!empty($url)) {
            foreach ($url as $value) {
                $pic = $value->getDisplayUrl();
                $url = $pic;
                $downloadDir = public_path() . "/highlights";
                $fileName = MediaDownloadHelper::downloadMedia($url, $downloadDir);
                array_push($pictures, $fileName);
            }
            dd($pictures);
        }
        $highlight = array_slice($pictures, 0, 4);
        return view('insta-highlights', compact('tab', 'highlight', 'user'));
    }

    public function index(Request $request)
    {

        if (empty($request->id))
            $tab = new InstaHighlight();
        else
            $post = InstaHighlight::find($request->id);

        $post->title = $request->title;
        $post->click = $request->click;
        $post->highlight = $request->highlight;
        $post->user_id = 2;
        $post->save();
        return redirect('insta-highlights-show');
    }
}
