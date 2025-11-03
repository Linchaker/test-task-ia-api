<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function getData(): object
    {
        $requestClass = static::class;
        $dataClass = Str::replaceFirst('App\\Http\\Requests', 'App\\Data', $requestClass);
        $dataClass = Str::replaceLast('Request', 'Data', $dataClass);

        if (!class_exists($dataClass)) {
            throw new \RuntimeException("Data class [$dataClass] not found for [$requestClass]");
        }

        return $dataClass::from($this->validated());
    }
}
