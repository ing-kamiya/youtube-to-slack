<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Services\SlackService;

class SlackServiceTest extends TestCase
{
    public function test_200(): void
    {
        Http::fake([
            'https://hooks.slack.com/*' => Http::response('ok', 200),
        ]);

        config(['services.slack.webhook_url' => 'https://hooks.slack.com/test']);

        $service = new SlackService();
        $url = 'https://www.youtube.com/watch?v=T7wKS5BiSEs';
        $service->sendSlackMessage($url);

        Http::assertSent(function ($request) use ($url) {
            return $request->url() === 'https://hooks.slack.com/test'
                && $request['text'] === $url;
        });
    }
}
