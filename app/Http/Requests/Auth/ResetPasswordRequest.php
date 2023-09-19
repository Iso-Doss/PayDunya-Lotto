<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class ResetPasswordRequest extends FormRequest
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
            'email' => ['required', 'string', 'email:strict', 'max:255', 'exists:password_reset_tokens,email'],
            'token' => ['required', 'string', 'max:255', 'exists:password_reset_tokens,token'],
            'password' => ['required', 'string', 'max:255', Rules\Password::defaults(), 'confirmed'],
            'password_confirmation' => ['required', 'string', 'max:255', Rules\Password::defaults(), 'same:password'],
            'profile' => ['required', 'string', 'max:255', 'in:CUSTOMER,AGENT,ADMINISTRATOR']
        ];
    }
}
