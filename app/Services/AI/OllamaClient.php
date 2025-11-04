<?php

declare(strict_types=1);

namespace App\Services\AI;

use App\Services\AI\Contracts\AIClientInterface;
use App\Services\AI\DTOs\AIMessage;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class OllamaClient implements AIClientInterface
{
    public function __construct(
        protected string $baseUrl,
        protected string $model
    ) {}

    /**
     * @throws ConnectionException
     */
    public function send(array $messages, ?string $model = null, bool $stream = false): array|string|null
    {
        $payload = [
            'model' => $model ?? $this->model,
            'messages' => collect($messages)->map(fn (AIMessage $m) => [
                'role' => $m->role->value,
                'content' => $m->content,
            ])->toArray(),
            'thinking' => false,
            'stream' => $stream,
        ];

        $response = Http::acceptJson()
            ->timeout(60)
            ->post("{$this->baseUrl}/api/chat", $payload);

        if (!$response->successful()) {
            throw new \RuntimeException('Ollama request failed: ' . $response->body());
        }

        $data = $response->json();

        return $data['message']['content'] ?? $data;
    }
}
