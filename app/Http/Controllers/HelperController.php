<?php

namespace App\Http\Controllers;
use Instagram\Model\ReelsFeed;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function stories($profile,$api)
    {
        $feedStories = $api->getStories($profile->getId());
        $stories = $feedStories->getStories();
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

   
}
