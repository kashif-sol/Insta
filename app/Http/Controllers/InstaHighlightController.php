<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        $post = new InstaHighlight();
        $post->title = $request->title;
        $post->click = $request->click;
        $post->highlight = $request->highlight;
        $post->user_id = $request->user_id;
        $post->save();
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {


            $helper = new HelperController;
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            $profile = $api->getProfile('sports');
            $fullname = $profile->getFullName();
            $pictures = [];
            $storyHighlights = $api->getStoryHighlightsFolder($profile->getId());
            
            foreach ($storyHighlights->getFolders() as $folder) {
                $folder = $api->getStoriesOfHighlightsFolder($folder);
                $url=$folder->getStories();
                foreach ($url as $value) {
                 $pic= $value->getDisplayUrl();
                 $url = $pic;
                 $downloadDir = public_path() . "/highlights";
                 $fileName = MediaDownloadHelper::downloadMedia($url, $downloadDir);
                 array_push($pictures, $fileName);
                }
            }
            $highlight = array_slice($pictures, 0, 4);
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }

        return view('insta-highlights', compact('post','highlight'));
    }
    public function update(Request $request, $id)
    {
        $post = InstaHighlight::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $request->title,
                'click' => $request->click,
                'highlight' => $request->highlight,
            ],
        );
        return view('insta-highlights', compact('post'));
    }
}
