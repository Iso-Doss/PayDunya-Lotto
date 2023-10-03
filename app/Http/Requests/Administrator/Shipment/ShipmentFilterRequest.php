<?php

namespace App\Http\Requests\Administrator\Shipment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShipmentFilterRequest extends FormRequest
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
            'state' => ['nullable', 'in:ENABLE,DISABLE,TRASHED'],
            'shipment_number' => ['nullable', 'string', 'max:255'],
            'warehouse_id' => ['nullable', Rule::exists('warehouses', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'status' => ['nullable', Rule::exists('statuses', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'shipment_type_id' => ['nullable', Rule::exists('shipment_types', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
        ];
    }
}
