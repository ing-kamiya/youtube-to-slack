<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class NotifyYoutubeVideoTest extends TestCase
{
    public function test(): void
    {
        Http::fake([
            'https://www.googleapis.com/youtube/v3/search*' => Http::response([
                'items' => [
                    ['id' => ['videoId' => 'abc123']],
                ],
            ], 200),
            'https://hooks.slack.com/*' => Http::response('ok', 200),
        ]);

        config(['services.slack.webhook_url' => 'https://hooks.slack.com/test']);

        $this->artisan('app:notify-youtube-video');

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'googleapis.com/youtube/v3/search');
        });

        Http::assertSent(function ($request) {
            return $request->url() === 'https://hooks.slack.com/test'
                && str_contains($request['text'], 'youtube.com/watch?v=');
        });
    }
}
