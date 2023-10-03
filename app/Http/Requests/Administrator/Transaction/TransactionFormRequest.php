<?php

namespace App\Http\Requests\Administrator\Transaction;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionFormRequest extends FormRequest
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
            'user_id' => ['required', 'numeric', Rule::exists('users', 'id')->where(fn(Builder $query) => $query->where('profile', '=', 'CUSTOMER')->whereNotNull('activated_at')->whereNotNull('verified_at')->whereNull('deleted_at'))],
            'lottery_id' => ['required', 'numeric', Rule::exists('lotteries', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'transaction_type_id' => ['required', 'numeric', Rule::exists('transaction_types', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'status_id' => ['required', 'numeric', Rule::exists('transaction_types', 'id')->where(fn(Builder $query) => $query->where('entity', '=', 'TRANSACTION')->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'ticket_id' => ['nullable', 'numeric', Rule::exists('tickets', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'amount' => ['required', 'numeric'],
            'details' => ['nullable', 'string'],
        ];
    }
}
