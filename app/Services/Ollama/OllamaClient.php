<?php

declare(strict_types=1);

namespace App\Services\Ollama;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class OllamaClient
{
    /**
     * @throws ConnectionException
     */
    public function sendMessage(string $systemPrompt, string $content): ?array
    {
        $payload = [
            'model' => config('ollama.model'),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt,
                ],
                [
                    'role' => 'user',
                    'content' => $content,
                ],
            ],
            'thinking' => false,
            'stream' => false,
        ];
//        dd($payload['messages'][0]['content']);
        $response = Http::acceptJson()->post(config('ollama.url'), $payload);

        if (!$response->successful()) {
            logger()->error('Ollama request failed', ['response' => $response->body()]);
            return null;
        }

        $json = $response->json();

        // {"message": {"content": "{...json...}"}}
        $content = data_get($json, 'message.content');

        return json_decode($content, true) ?? null;
    }
}
