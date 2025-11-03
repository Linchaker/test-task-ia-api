<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin string
 */
class PromptResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);

        JsonResource::withoutWrapping();
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->resource,
        ];
    }
}
