<?php

namespace App\Http\Controllers;

use App\Services\YoutubeService;
use App\Services\SlackService;

class VideoController extends Controller
{
    public function __construct(
        private YoutubeService $youtubeService,
        private SlackService $slackService,
    ){}

    public function notify():void {
        $url = $this->youtubeService->getVideoURL();

        $this->slackService->sendSlackMessage($url);
        dd('送信済み');
    }
}
