<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Services\YoutubeService;

class YoutubeServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_200(): void
    {
        Http::fake([
            'https://www.googleapis.com/youtube/v3/search*' => Http::response([
                'items' => [
                    ['id' => ['videoId' => 'abc123']],
                ],
            ], 200),
        ]);
        $service = new YoutubeService();
        $url = $service->getVideoURL();

        $this->assertSame('https://www.youtube.com/watch?v=abc123', $url);
    }
}
