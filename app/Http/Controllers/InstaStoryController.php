<?php

namespace App\Http\Controllers;

use App\Models\InstaStory;
use App\Models\InstaFeed;
use App\Models\Instagram;
use Session;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;
use Instagram\Model\Media;
use Instagram\Utils\MediaDownloadHelper;


class InstaStoryController extends Controller
{
    public function view_story(){
        $user = Instagram::where('user_id','4284451936')->first();

        $data = InstaStory::where('user_id',2)->first(); 
        if(!isset($data)){
            return view('insta-stories');
        }
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {


            $helper = new HelperController;
            $api = new Api($cachePool);
           
            $api->login('festedurto', 'newsfeed');
            // $profiles = $request->profile;
            $profile = $api->getProfile('kmushtaq7');
            // dd($profile);
            $id=$profile->getId();
            // $profile = $api->getProfile('kmushtaq7');
            $fullname = $profile->getFullName();
            $feedStories = $api->getStories($profile->getId());
           
            $pictures = [];
            $stories = $feedStories->getStories();
            
            foreach ($stories as $stories) {

                // $fileName = MediaDownloadHelper::downloadMedia($media->getDisplaySrc());
                $pic = $stories->getDisplayUrl();

                $url = $pic;
                $downloadDir = public_path() . "/assets";

                $fileName = MediaDownloadHelper::downloadMedia($url, $downloadDir);
                array_push($pictures, $fileName);
            }
           
            if($data->story=='all'){



                $story = $pictures;
                }
                else if($data->story==2){
                    $story = array_slice($pictures, 0, 2);
                 
                }
                else{
                    $story = array_slice($pictures, 0, 1);
                }
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }

        return view('insta-stories', compact('data', 'story','user'));


    }

    public function index(Request $request)
    {
        $post = new InstaStory();
        $post->title = $request->title;
        $post->click = $request->click;
        $post->story = $request->story;
        $post->user_id = 2;
        $post->save();
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {


            $helper = new HelperController;
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            // $profiles = $request->profile;
            $profile = $api->getProfile('ptiofficiali');
            // $profile = $api->getProfile('kmushtaq7');
            $fullname = $profile->getFullName();
            // $stories = $helper->stories($profile,$api);
            // $reels = $helper->reels($profile,$api);
            // $feeds =$helper->media($profile,$api);
            // $medias = $profile->getMedias(); 

            $feedStories = $api->getStories($profile->getId());
            $pictures = [];
            $stories = $feedStories->getStories();
            foreach ($stories as $stories) {

                // $fileName = MediaDownloadHelper::downloadMedia($media->getDisplaySrc());
                $pic = $stories->getDisplayUrl();

                $url = $pic;
                $downloadDir = public_path() . "/assets";

                $fileName = MediaDownloadHelper::downloadMedia($url, $downloadDir);
                array_push($pictures, $fileName);
            }
            if($post->story=='all'){



                $story = $pictures;
                }
                else if($post->story==2){
                    $story = array_slice($pictures, 0, 2);
                 
                }
                else{
                    $story = array_slice($pictures, 0, 1);
                }
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }

        return redirect('insta-story-show');
    }
    public function update(Request $request, $id)
    {
        $post = InstaStory::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $request->title,
                'click' => $request->click,
                'story' => $request->story,
            ],
        );
        return view('insta-stories', compact('post'));
    }
}
