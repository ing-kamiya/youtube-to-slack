<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Services\YoutubeService;
use App\Services\SlackService;

#[Signature('app:notify-youtube-video')]
#[Description('YouTubeの動画のURLをランダムにSlackに通知する')]
class NotifyYoutubeVideo extends Command
{
    public function __construct(
        private YoutubeService $youtubeService,
        private SlackService $slackService,
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $url = $this->youtubeService->getVideoURL();

        $this->slackService->sendSlackMessage($url);
    }
}
