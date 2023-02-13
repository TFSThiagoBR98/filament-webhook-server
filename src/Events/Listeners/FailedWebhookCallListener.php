<?php

namespace Marjose123\FilamentWebhookServer\Events\Listeners;

use Illuminate\Support\Facades\Log;
use Marjose123\FilamentWebhookServer\Models\FilamentWebhookServerHistory;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;

class FailedWebhookCallListener
{
    public function __construct()
    {
    }

    public function handle(FinalWebhookCallFailedEvent $event)
    {
       /* if (config('filament-webhook-server.webhook.keep_history', true)) {
            $webhookClientHistory = new FilamentWebhookServerHistory();
            $webhookClientHistory->webhook_client = $event->meta['webhookClient'];
            $webhookClientHistory->uuid = $event->uuid;
            $webhookClientHistory->status_code = $event->response->getStatusCode();
            $webhookClientHistory->errorMessage = $event->errorMessager;
            $webhookClientHistory->errorType = $event->errorType;
            $webhookClientHistory->attempt = $event->attempt;
            $webhookClientHistory->save();
            $res = $webhookClientHistory->save();
            Log::info($res);
            app('log')->info("Success webhook call");
            app('log')->info($res);
        }*/
        $webhookClientHistory = new FilamentWebhookServerHistory();
        $webhookClientHistory->webhook_client = $event->meta['webhookClient'];
        $webhookClientHistory->uuid = $event->uuid;
        $webhookClientHistory->status_code = $event->response->getStatusCode();
        $webhookClientHistory->errorMessage = $event->response->getReasonPhrase();
        $webhookClientHistory->errorType = $event->errorType;
        $webhookClientHistory->attempt = $event->attempt;
        $webhookClientHistory->save();
        $res = $webhookClientHistory->save();
        Log::debug($res);
        app('log')->debug("Success webhook call");
        app('log')->debug($res);
    }
}
