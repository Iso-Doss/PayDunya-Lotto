<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdatePasswordProfileRequest extends FormRequest
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
            'current_password' => ['required', 'string', 'max:255', Rules\Password::defaults()],
            'new_password' => ['required', 'string', 'max:255', Rules\Password::defaults(), 'confirmed'],
            'new_password_confirmation' => ['required', 'string', 'max:255', Rules\Password::defaults(), 'same:new_password']
        ];
    }
}
