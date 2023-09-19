<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SendEmailValidateAccountRequest extends FormRequest
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
            'profile' => ['required', 'string', 'max:255', 'in:CUSTOMER,AGENT,ADMINISTRATOR'],
            'email' => ['required', 'string', 'email:strict', 'max:255', 'exists:users,email']
        ];
    }
}
