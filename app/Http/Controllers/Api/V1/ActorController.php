<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\Actor\AddActorAction;
use App\Http\Requests\Actor\AddActorRequest;
use App\Http\Resources\PromptResource;

class ActorController extends ApiController
{
    public function store(AddActorRequest $request, AddActorAction $action): void
    {
        $action->handle($request->getData());
    }

    public function getPrompt(): PromptResource
    {
        return new PromptResource(config('ollama.parser_prompt'));
    }

}
