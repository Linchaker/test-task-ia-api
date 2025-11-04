<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\Actor\AddActorAction;
use App\Http\Requests\Actor\AddActorRequest;
use App\Http\Resources\PromptResource;
use App\Services\Actor\Contracts\ActorDataParserInterface;
use Illuminate\Http\Response;

class ActorController extends ApiController
{
    public function store(AddActorRequest $request, AddActorAction $action): Response
    {
        return $action->handle($request->getData());
    }

    public function getPrompt(ActorDataParserInterface $parser): PromptResource
    {
        return new PromptResource($parser::getDefaultParserPrompt());
    }
}
