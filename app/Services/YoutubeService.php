<?php

namespace App\Services;

use App\Exceptions\YouTubeApiException;
use Illuminate\Support\Facades\Http;

class YoutubeService
{
    // youtube APIを叩いてデータを取得する
    public function getVideoURL(): string
    {
        $response = Http::get(
            'https://www.googleapis.com/youtube/v3/search',
            [
                'key' => config('services.youtube.api_key'),
                'channelId' => 'UC1h483R01zEPVlMxAE2BOow',
                'part' => 'snippet',
                'maxResults' => 25,
                'type' => 'video',
            ]
        )->json();

        if (!is_array($response)) {
            throw new YouTubeApiException('Invalid YouTube API response.');
        }

        $items = $response['items'];
        if (!is_array($items)) {
            throw new YouTubeApiException('Invalid YouTube API response items.');
        }

        $randomItemKey = array_rand($items);
        $item = $items[$randomItemKey];
        if (!is_array($item)) {
            throw new YouTubeApiException('Invalid YouTube API response item.');
        }

        $itemId = $item['id'];
        if (!is_array($itemId)) {
            throw new YouTubeApiException('Invalid YouTube API response item id.');
        }

        $videoId = $itemId['videoId'];
        if (!is_string($videoId)) {
            throw new YouTubeApiException('Invalid YouTube API response video id.');
        }

        return "https://www.youtube.com/watch?v={$videoId}";
    }
}
