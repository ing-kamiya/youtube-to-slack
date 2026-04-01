<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/youtube-test', function () {
    $response = \Illuminate\Support\Facades\Http::get(
        'https://www.googleapis.com/youtube/v3/videos',
        [
            'key'  => env('YOUTUBE_API_KEY'),
            'channelId'   => 'UC1h483R01zEPVlMxAE2BOow',
            'part' => 'snippet,statistics',
        ]
    );

    dd($response->json()); // ←レスポンスの中身を確認
});

