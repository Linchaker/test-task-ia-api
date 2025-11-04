<?php

declare(strict_types=1);

namespace App\Services\AI;

use App\Services\AI\Contracts\AIClientInterface;
use App\Services\AI\DTOs\AIMessage;
use Illuminate\Support\Facades\Http;

class OpenAIClient implements AIClientInterface
{
    public function __construct(
        protected string $apiKey,
        protected string $baseUrl = 'https://api.openai.com/v1',
        protected string $model = 'gpt-4.1-mini'
    ) {}

    public function send(array $messages, ?string $model = null, bool $stream = false): array|string|null
    {
        $payload = [
            'model' => $model ?? $this->model,
            'messages' => collect($messages)->map(fn (AIMessage $m) => [
                'role' => $m->role->value,
                'content' => $m->content,
            ])->toArray(),
        ];

        if ($stream) {
            $payload['stream'] = true;
        }

        $response = Http::withToken($this->apiKey)
            ->timeout(60)
            ->post("{$this->baseUrl}/chat/completions", $payload);

        if (!$response->successful()) {
            throw new \RuntimeException('OpenAI request failed: ' . $response->body());
        }

        $data = $response->json();

        return $data['choices'][0]['message']['content'] ?? $data;
    }
}
