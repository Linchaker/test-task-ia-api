<?php

declare(strict_types=1);

namespace App\Services\Actor;

use App\Services\Actor\Contracts\ActorDataParserInterface;
use App\Services\AI\Contracts\AIClientInterface;
use App\Services\AI\DTOs\AIMessage;

class ActorDataParser implements ActorDataParserInterface
{
    public function __construct(protected AIClientInterface $ai)
    {
        //
    }

    public function parse(string $description, string $systemPrompt = null): array
    {
        $system = AIMessage::system(static::getDefaultParserPrompt($systemPrompt));
        $user = AIMessage::user($description);

        try {
            $result = $this->ai->send([$system, $user]);
        } catch (\Throwable $e) {
            throw new \RuntimeException('AI service is currently unavailable. Try later', 503);
        }

        $decoded = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
            throw new \RuntimeException('AI service returned invalid response. Try again', 502);
        }

        return $decoded;
    }

    public static function getDefaultParserPrompt(string $systemPrompt = null): string
    {
        if ($systemPrompt) return $systemPrompt;

        return 'You are a data extractor. Your task is to read any message from the user and identify any information about the user that corresponds '
            . 'to the following fields: first_name, last_name, address, height (in cm), weight (in kg), gender (if no info, try to guess by name, use only male or female), '
            . 'age (in years). The user may write in natural language and not explicitly label the fields. '
            . 'Extract only the information you can find and return it as a JSON object. '
            . 'Do not include fields with no values. '
            . 'The JSON must be the only output, no explanations or extra text. '
            . 'Field names: first_name, last_name, address, height, weight, gender, age.';
    }
}
