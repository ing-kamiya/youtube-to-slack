<?php

namespace App\Http\Controllers;

use App\Services\YoutubeService;

class VideoController extends Controller
{
    public function __construct(
        private YoutubeService $youtubeService,
    ){}

    public function notify():void {
        $url = $this->youtubeService->getVideoURL();

        dd($url);
    }
}
