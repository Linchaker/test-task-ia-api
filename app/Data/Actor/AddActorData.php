<?php

namespace App\Data\Actor;

use Spatie\LaravelData\Data;

class AddActorData extends Data
{
    public string $email;
    public string $first_name;
    public string $last_name;
    public string|null $address;
    public string|null $height;
    public string|null $weight;
    public string|null $gender;
}
