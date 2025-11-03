<?php

declare(strict_types=1);

namespace App\Services\Actor;

use App\Services\Actor\Contracts\ActorDataParserInterface;
use App\Services\Ollama\OllamaClient;

class ActorDataParser implements ActorDataParserInterface
{
    public function __construct(protected OllamaClient $ollama)
    {
        //
    }

    public function parse(string $description, string $systemPrompt = null): array
    {
        $systemPrompt = $systemPrompt ?: config('ollama.parser_prompt');

        return $this->ollama->sendMessage($systemPrompt, $description) ?? [];
    }
}
