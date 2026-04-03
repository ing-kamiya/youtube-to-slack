<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class SlackService {
    // Webhook URLを使ってslackにメッセージを送る
    public function sendSlackMessage(string $url) {
        $response = Http::post(
            env('SLACK_WEBHOOK_URL'),
            ['text' => $url,]
        )->json();

        return $response;
    }
}