<?php

declare(strict_types=1);

namespace App\Services\AI\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static System()
 * @method static static Assistant()
 * @method static static User()
 */
final class AIMessageRoleEnum extends Enum
{
    const System = 'system';
    const Assistant = 'assistant';
    const User = 'user';
}
