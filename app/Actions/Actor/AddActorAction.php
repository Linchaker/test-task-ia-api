<?php

namespace App\Actions\Actor;

use App\Data\Actor\AddActorData;
use App\Models\Actor;
use Lorisleiva\Actions\Concerns\AsAction;

class AddActorAction
{
    use AsAction;

    public function handle(AddActorData $data): void
    {
        Actor::query()->create($data->toArray());
    }
}
