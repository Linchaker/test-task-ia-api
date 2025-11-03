<?php

declare(strict_types=1);

namespace App\Services\Actor\Contracts;

interface ActorDataParserInterface
{
    public function parse(string $description): array;
}
