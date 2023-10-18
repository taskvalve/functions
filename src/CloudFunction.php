<?php

declare(strict_types=1);

namespace TaskValve;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Workflow\Activity;

class CloudFunction extends Activity
{
    protected function auth(): array
    {
        return Cache::remember('taskvalve.auth', 3600, static function () {
            return Http::withToken(config('services.taskvalve.api_key'))
                ->get('https://api.taskvalve.com/functions/v1/get-user')
                ->json();
        });
    }

    public function execute($functionName, ...$args)
    {
        $auth = $this->auth();

        $response = Http::withToken($auth['token'])
            ->withHeaders([
                'apiKey' => $auth['public'],
                'Idempotency-Key' => hash('sha256', $this->storedWorkflow->id . $this->index),
            ])
            ->post("https://functions.taskvalve.com/{$auth['user']}/{$functionName}", [
                'args' => $args,
            ]);

        return $response->json();
    }
}
