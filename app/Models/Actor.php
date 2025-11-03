<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ActorGender;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Actor
 *
 * @property int $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property float|null $height
 * @property float|null $weight
 * @property ActorGender|null $gender
 * @property int|null $age
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Actor extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'gender' => ActorGender::class,
    ];
}
