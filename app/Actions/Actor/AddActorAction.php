<?php

namespace App\Actions\Actor;

use App\Data\Actor\AddActorData;
use App\Models\Actor;
use Illuminate\Http\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class AddActorAction
{
    use AsAction;

    public function handle(AddActorData $data): Response
    {
        Actor::query()->create($data->toArray());
        return response()->noContent();
    }
}
