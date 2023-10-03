<?php

namespace App\Http\Requests\Administrator\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserFilterRequest extends FormRequest
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
            'profile' => ['nullable', 'in:CUSTOMER,ADMINISTRATOR'],
            'status' => ['nullable', 'in:ENABLE,DISABLE,TRASHED'],
            'first_last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email:strict', 'max:255'],
            'phone_number' => ['nullable', 'numeric'],
        ];
    }
}
