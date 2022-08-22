<?php

namespace App\Http\Controllers;

use App\Models\InstaFeed;
use App\Models\Instagram;
use Session;
use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Illuminate\Http\Request;
use Instagram\Exception\InstagramException;
use Instagram\Model\Media;
use Instagram\Utils\MediaDownloadHelper;

class InstaFeedController extends Controller
{
    public function index(Request $request){
        $post = new InstaFeed();
        $post->title = $request->title;
        $post->layout = $request->layout;
        $post->spacing = $request->spacing;
        $post->click = $request->click;
        $post->border = $request->border;
        $post->column = $request->column;
        $post->load_more = $request->load_more;
        $post->user_id = $request->user_id;
        $post->save();
        // ...insta data
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {     
            
            
            $helper = new HelperController;
            $api = new Api($cachePool);
            $api->login('festedurto','newsfeed');
            // $profiles = $request->profile;
            $profile = $api->getProfile('kmushtaq7');
          // $profile = $api->getProfile('kmushtaq7');
            $fullname=$profile->getFullName();
            $stories = $helper->stories($profile,$api);
            $reels = $helper->reels($profile,$api);
            $feeds =$helper->media($profile,$api);
            $medias = $profile->getMedias(); 
            $pictures=[];
            // function downloadMedias(array $medias)
            // {
               
                /** @var Media $media */
                foreach ($medias as $media) {
                    
                        // $fileName = MediaDownloadHelper::downloadMedia($media->getDisplaySrc());
                 $pic=$media->getDisplaySrc();
                //  dd($pic);

                $url = $pic;

                // define directory
                // $downloadDir = __DIR__ . '.../public/assets'; // change it
                $downloadDir=public_path(). "/assets";
                
                $fileName = MediaDownloadHelper::downloadMedia($url, $downloadDir);

                 array_push($pictures,$fileName);
                    
                  
                    // echo 'Media downloaded as : ' . $fileName . PHP_EOL;
                }
            
// dd($pictures);
            // downloadMedias($profile->getMedias());
           
       $arr=[];
        foreach ($medias as $media) {
            $link=$media->getLink();
            array_push($arr,$link );
        }
      
    //   dd($arr);


//         foreach ($feed as $das) {
//             foreach ($das as $key=>$da) {
// var_dump($da);
//             }
//         }
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }
        return view('insta-feed',compact('post','feeds','arr','pictures'));
    }

   
    public function update(Request $request, $id){
       $post= InstaFeed::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'title' => $request->title,
                'layout' => $request->layout,
                'spacing' => $request->spacing,
                'click' => $request->click,
                'border' => $request->border,
                'column' => $request->column,
                'load_more' => $request->load_more,
                
            ],
        );
       return view('insta-feed',compact('post'));

    }
}
