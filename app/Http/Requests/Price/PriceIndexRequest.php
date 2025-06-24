<?php

namespace App\Http\Requests\Price;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PriceIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'currency' => [
                'nullable',
                'string',
                Rule::in(['RUB', 'USD', 'EUR']),
            ],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'currency.in' => 'The currency must be one of RUB, USD, or EUR.',
        ];
    }

    /**
     * Get the validated currency or default to RUB.
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->validated()['currency'] ?? 'RUB';
    }
}
