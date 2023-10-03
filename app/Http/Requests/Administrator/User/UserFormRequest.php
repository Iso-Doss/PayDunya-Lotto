<?php

namespace App\Http\Requests\Administrator\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
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
            'email' => ['required', 'email:strict', 'max:255', Rule::unique('users', 'email')->where(fn(Builder $query) => $query->where('profile', $this->input('profile')))],
        ];
    }
}
