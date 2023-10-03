<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class SignUpRequest extends FormRequest
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
        $data = $this->all();

        $rules = [
            'email' => ['required', 'email:strict', 'max:255', Rule::unique('users', 'email')->where(fn(Builder $query) => $query->where('profile', $this->input('profile') ?? 'CUSTOMER'))],
            'profile' => ['required', 'string', 'max:255', 'in:CUSTOMER,ADMINISTRATOR'],
            'has_default_password' => ['nullable', 'boolean'],
            'terms_condition' => ['required', 'boolean']
        ];

        if ((isset($data['has_default_password']) && !$data['has_default_password']) || !isset($data['has_default_password'])) {
            $rules['password'] = ['required', 'string', 'max:255', Rules\Password::defaults(), 'confirmed'];
            $rules['password_confirmation'] = ['required', 'string', 'max:255', Rules\Password::defaults(), 'same:password'];
        }

        return $rules;
    }
}
