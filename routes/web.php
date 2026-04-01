<?php

use Illuminate\Support\Facades\Route;

Route::get('/youtube-test', function () {
    $response = \Illuminate\Support\Facades\Http::get(
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
    $url = "https://www.youtube.com/watch?v={$videoId}";

    dd($url);
});