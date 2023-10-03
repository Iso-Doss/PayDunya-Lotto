<?php

namespace App\Http\Requests\Administrator\Country;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique('countries', 'name')->where(fn(Builder $query) => $query->where('id', '<>', $this->input('country_id')))],
            'code' => ['required', 'string', 'max:255', Rule::unique('countries', 'code')->where(fn(Builder $query) => $query->where('id', '<>', $this->input('country_id')))],
            'phone_code' => ['required', 'numeric', Rule::unique('countries', 'phone_code')->where(fn(Builder $query) => $query->where('id', '<>', $this->input('country_id')))],
        ];
    }
}
