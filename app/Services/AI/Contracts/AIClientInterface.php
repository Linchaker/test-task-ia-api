<?php

declare(strict_types=1);

namespace App\Services\AI\Contracts;

use App\Services\AI\DTOs\AIMessage;

interface AIClientInterface
{
    /**
     * Send msg to AI-model.
     *
     * @param AIMessage[] $messages
     * @param string|null $model
     * @param bool $stream
     * @return array|string|null
     */
    public function send(array $messages, ?string $model = null, bool $stream = false): array|string|null;
}
