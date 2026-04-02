<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
class YoutubeService {
    // youtube APIを叩いてデータを取得する
    public function getVideoURL() {
        $response = Http::get(
            'https://www.googleapis.com/youtube/v3/search',
            [
                'key'        => env('YOUTUBE_API_KEY'),
                'channelId'  => 'UC1h483R01zEPVlMxAE2BOow',
                'part'       => 'snippet',
                'maxResults' => 25,
                'type'       => 'video',
            ]
        )->json();
    
        $items = $response['items'];
    
        $randomItemKey = array_rand($items);
    
        $videoId = $items[$randomItemKey]['id']['videoId'];

        return "https://www.youtube.com/watch?v={$videoId}";
    
    }
}
