<?php

namespace App\Http\Requests\Actor;

use App\Enums\ActorGender;
use App\Http\Requests\BaseRequest;
use App\Services\Actor\Contracts\ActorDataParserInterface;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AddActorRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        $description = $this->input('description');

        if (empty($description)) {
            throw ValidationException::withMessages([
                'description' => __('The description field is required.'),
            ]);
        }

        /** @var ActorDataParserInterface $parser */
        $parser = app(ActorDataParserInterface::class);

        $data = $parser->parse($description);

        if (!empty($data)) {
            $this->merge($data);
        }

        $required = ['first_name', 'last_name', 'address'];
        foreach ($required as $field) {
            if (empty($this->input($field))) {
                throw ValidationException::withMessages([
                    'description' => __('Please add first name, last name, and address to your description.'),
                ]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email:rfc',
                'max:255',
                Rule::unique('actors', 'email'),
            ],
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'height' => [
                'nullable',
                'numeric',
                'min:0',
                'max:300',
            ],
            'weight' => [
                'nullable',
                'numeric',
                'min:0',
                'max:500',
            ],
            'gender' => [
                'nullable',
                 new EnumValue(ActorGender::class),
            ],
            'age' => [
                'nullable',
                'integer',
                'min:0',
                'max:120',
            ],
        ];
    }
}
