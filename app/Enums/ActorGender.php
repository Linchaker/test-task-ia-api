<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Male()
 * @method static static Female()
 */
final class ActorGender extends Enum
{
    const Male = 'male';
    const Female = 'female';
}
