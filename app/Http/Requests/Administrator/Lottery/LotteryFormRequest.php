<?php

namespace App\Http\Requests\Administrator\Lottery;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LotteryFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'jackpot' => ['required', 'numeric'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'status_id' => ['nullable', 'numeric', Rule::exists('statuses', 'id')->where(fn(Builder $query) => $query->where('entity', '=', 'LOTTERY')->whereNotNull('activated_at')->whereNull('deleted_at'))],
        ];
    }
}
