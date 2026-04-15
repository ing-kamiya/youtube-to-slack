<?php

namespace App\Services;

use App\Exceptions\SlackApiException;
use Illuminate\Support\Facades\Http;

class SlackService
{
    // Webhook URLを使ってslackにメッセージを送る
    public function sendSlackMessage(string $url): mixed
    {
        $webhookUrl = config('services.slack.webhook_url');
        if (!is_string($webhookUrl)) {
            throw new SlackApiException('SLACK_WEBHOOK_URL is not configured.');
        }

        $response = Http::post(
            $webhookUrl,
            ['text' => $url]
        )->json();

        return $response;
    }
}
