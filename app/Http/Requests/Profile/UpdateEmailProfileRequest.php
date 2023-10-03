<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateEmailProfileRequest extends FormRequest
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
            'profile' => ['required', 'string', 'max:255', 'in:CUSTOMER,ADMINISTRATOR'],
            'email' => ['required', 'email:strict', 'max:255', Rule::unique('users', 'email')->where(fn(Builder $query) => $query->where('profile', $this->input('profile') ?? 'CUSTOMER')->where('id', '<>', Auth::user()->id))],
            'password' => ['required', 'string', 'max:255', Rules\Password::defaults()]
        ];
    }
}
