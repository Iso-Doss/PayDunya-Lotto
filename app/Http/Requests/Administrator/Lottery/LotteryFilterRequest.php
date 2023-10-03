<?php

namespace App\Http\Requests\Administrator\Lottery;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LotteryFilterRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'date'],
            'jackpot' => ['nullable', 'numeric'],
            'user_id' => ['nullable', 'numeric', Rule::exists('users', 'id')->where(fn(Builder $query) => $query->where('profile', '=', 'CUSTOMER')->whereNotNull('activated_at')->whereNotNull('verified_at')->whereNull('deleted_at'))],
            'status_id' => ['nullable', 'numeric', Rule::exists('statuses', 'id')->where(fn(Builder $query) => $query->where('entity', '=', 'LOTTERY')->whereNotNull('activated_at')->whereNull('deleted_at'))],
        ];
    }
}
