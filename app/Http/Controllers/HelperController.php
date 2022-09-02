<?php

namespace App\Http\Controllers;
use Instagram\Model\ReelsFeed;
use Illuminate\Http\Request;
use App\Models\Instagram;
use App\Models\InstaHighlight;
use App\Models\InstaStory;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\Storage;
use Session;
use Instagram\Api;
use Instagram\Auth\Checkpoint\ImapClient;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Instagram\Exception\InstagramException;
use Instagram\Model\Media;
use Instagram\Utils\MediaDownloadHelper;
use Psr\Cache\CacheException;


class HelperController extends Controller
{
    public function insta_stories($username = "ptiofficial")
    {
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        $stories = [];
        try {
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            $profile = $api->getProfile($username);
            sleep(1);
            $feedStories = $api->getStories($profile->getId());

            $stories = $feedStories->getStories();
           
            // $story=$stories->toArray();           
        }
        catch (InstagramException $e) {
            dd($e->getMessage());
        }

        return $stories;
    }

    public function insta_feeds($username = "ptiofficial")
    {
        $feeds = [];
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        $my_feeds = [];
        try {
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            $profile = $api->getProfile($username);
            sleep(1);
            $feeds = $profile->getMedias(); 
            $i = 0;
            foreach ($feeds as $media ) {
                if ($i++ > 3) break;
                $pic = $media->getDisplaySrc();
                $link = $media->getLink();
                $downloadDir = public_path() . "/feeds";
                $fileName = MediaDownloadHelper::downloadMedia($pic, $downloadDir);
                $my_feeds[] = array(
                    "link" => $link,
                    "file" => $fileName
                );
            }
                       
        }
        catch (InstagramException $e) {
            dd($e->getMessage());
        }

        return $my_feeds;
    }


    public function insta_reels($username = "kmushtaq7")
    {
        $reelsFeed = [];
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            $profile = $api->getProfile($username);
            $id = $profile->getId();
            sleep(1);
            $reelsFeed = $api->getReels($id); 
         
        }
        catch (InstagramException $e) {
            dd($e->getMessage());
        }

        return $reelsFeed;
    }
    public function insta_highlights($username = "ptiofficial")
    {
        $my_feeds = [];
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        try {
            $api = new Api($cachePool);
            $api->login('festedurto', 'newsfeed');
            $profile = $api->getProfile($username);
            sleep(1);
            $storyHighlights = $api->getStoryHighlightsFolder($profile->getId());
           $i = 0;
            foreach ($storyHighlights->getFolders() as $folder) {
                if ($i++ > 3) break;
                $folder = $api->getStoriesOfHighlightsFolder($folder);
                $link = $folder->getUrl();
                $Stories=$folder->getStories()[0];
                $pic = $Stories->getDisplayUrl();
                $downloadDir = public_path() . "/highlights";
                $fileName = MediaDownloadHelper::downloadMedia($pic, $downloadDir);
                $my_feeds[] = array(
                    "link" => $link,
                    "file" => $fileName
                );
            }
           
        } catch (InstagramException $e) {
            dd($e->getMessage());
        }
        return $my_feeds;


    }

    public function stories($profile,$api)
    {
        $feedStories = $api->getStories($profile->getId());
        $stories = $feedStories->getStories();
        dd($stories);
        return $stories;
    }
    public function reels($profile,$api)
    {
        $reelsFeed = $api->getReels($profile->getId());
        $all_reels = $this->printReels($reelsFeed);
        // dd($all_rerls);
         // id 25288085 is wendyswan (https://www.instagram.com/wendyswan)
        do {
                $reelsFeed = $api->getReels($profile->getId(), $reelsFeed->getMaxId());
                $this->printReels($reelsFeed);

                // avoid 429 Rate limit from Instagram
                sleep(1);
            } while ($reelsFeed->hasMaxId());

        return $all_reels; 
    }
    function printReels(ReelsFeed $reelsFeed)
    {
       $reels_array = [];
        /** @var \Instagram\Model\Reels $reels */
        foreach ($reelsFeed->getReels() as $reels) {
            $reel_data = [
                'ID:' => $reels->getId(),
                'Code:' => $reels->getShortCode(),
                'Caption:' => $reels->getCaption(),
                'Link:' => $reels->getVideos()[0]->url,
                'Likes: ' => $reels->getLikes(),
                'Date:' => $reels->getDate()->format('Y-m-d h:i:s')
            ];
            array_push($reels_array,$reel_data);
        }
        return $reels_array;
    }


    public function media($profile,$api)
    {
        $view_media=$this->printMedias($profile->getMedias());
        do {
            $profile = $api->getMoreMedias($profile);
            $this->printMedias($profile->getMedias());
            //$profile = $api->getMoreMediasWithProfileId(3504244670);
            // avoid 429 Rate limit from Instagram
            sleep(1);
        } while ($profile->hasMoreMedias());

        $igtv= $this->printMedias($profile->getIgtvs());

    do {
        $profile = $api->getMoreIgtvs($profile);
        $this->printMedias($profile->getIgtvs());

        // avoid 429 Rate limit from Instagram
        sleep(1);
    } while ($profile->hasMoreIgtvs());

    $all_feeds =['images'=>$view_media,'videos'=>$igtv];
    return $all_feeds;
    }
    function printMedias(array $medias)
    {
        $media_array = array();
        foreach ($medias as $media) {
            $media_data = [
                'ID:' => $media->getId(),
                'Caption:' => $media->getCaption(),
                'Link:' => $media->getLink(),
                'Likes: ' => $media->getLikes(),
                'Date:' => $media->getDate()->format('Y-m-d h:i:s')
            ];
            array_push($media_array,$media_data);
        }
        return $media_array;
    }
    public function test($instagram_user,$shop_id){
        $credentials = include_once realpath(dirname(__FILE__)) . '/credentials.php';
        // dd($credentials);
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/../cache');
        // dd($cachePool);
        try {
            $api        = new Api($cachePool);
          
            $imapClient = new ImapClient($credentials->getImapServer(), $credentials->getImapLogin(), $credentials->getImapPassword());
            dd($credentials->getImapLogin());
            $api->login($credentials->getLogin(), $credentials->getPassword(), $imapClient);
            $profile = $api->getProfile($instagram_user);//robertdowneyjr
           dd( $profile);
            $feedStories = $api->getStories($profile->getId());
//            dd( $feedStories);
            $stories = $feedStories->getStories();
        //    dd( $stories);
            foreach ($stories as $story) {
                $Story = InstaStory::where([
                    'shop_id' => $shop_id,
                    'instagram_user_name' => $instagram_user,
                    'media_id' => $story->getId(),
                ])->first();
                if ($Story == null) {
                    $Story = new InstaStory();
                    $Story->shop_id = $shop_id;
                    $Story->instagram_user_name = $instagram_user;
                    $Story->media_id = $story->getId();
                }
                $path = '/instagram/' . $instagram_user . '/stories';
                $get_path = public_path($path);
                if (!File::exists($get_path)) {
                    File::makeDirectory($get_path, 0777, true, true);
                }
                $contents = file_get_contents($story->getDisplayUrl());
//            $thumbnail_name = $path."/". substr($story->getDisplayUrl(), strrpos($story->getDisplayUrl(), '/') + 1);
                $thumbnail_name = $path . "/" . $story->getId() . ".jpg";
//            dd($thumbnail_name);
//            Storage::put($thumbnail_name, $contents);
                Storage::disk('public')->put($thumbnail_name, $contents);
                if ($story->getTypeName() == 'GraphStoryImage') {
                    $media_src = $thumbnail_name;
                    $type = 'image';
                } else {
//                dd($story);
                    $get_src = $story->getVideoResources();
                    $get_src = $get_src[0]->src;
                    $contents = file_get_contents($get_src);
//                $media_src = $path."/". substr($get_src, strrpos($get_src, '/') + 1);
                    $media_src = $path . "/" . $story->getId() . ".mp4";
                    Storage::disk('public')->put($media_src, $contents);
//                dd($media_src);
                    $type = 'video';
                }
                $Story->type = $type;
                $Story->thumbnail = $thumbnail_name;
                $Story->media_src = $media_src;
                $Story->hashtags = json_encode($story->getHashtags());
                $Story->date = $story->getTakenAtDate()->format('Y-m-d h:i:s');
                $Story->expire_date = $story->getExpiringAtDate()->format('Y-m-d h:i:s');
                $Story->save();
            }
        } catch (InstagramException $e) {
            abort(500, 'Stories not found');
            logs($e->getMessage());
        } catch (CacheException $e) {
            abort(500, 'Stories not found');
            logs($e->getMessage());
        }
    }

   
}
