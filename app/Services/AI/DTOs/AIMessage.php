<?php

declare(strict_types=1);

namespace App\Services\AI\DTOs;

use App\Services\AI\Enums\AIMessageRoleEnum;

class AIMessage
{
    public function __construct(
        public AIMessageRoleEnum $role,
        public string $content
    ) {}

    public static function system(string $content): self
    {
        return new self(AIMessageRoleEnum::System(), $content);
    }

    public static function assistant(string $content): self
    {
        return new self(AIMessageRoleEnum::Assistant(), $content);
    }

    public static function user(string $content): self
    {
        return new self(AIMessageRoleEnum::User(), $content);
    }
}
