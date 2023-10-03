<?php

namespace App\Http\Requests\Administrator\Country;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CountryFilterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['nullable', 'in:ENABLE,DISABLE,TRASHED'],
            'name' => ['nullable', 'string', 'max:255'],
            'code' => ['nullable'],
            'phone_code' => ['nullable'],
        ];
    }
}
