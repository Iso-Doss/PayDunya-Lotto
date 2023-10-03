<?php

namespace App\Http\Requests\Administrator\Shipment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShipmentFormRequest extends FormRequest
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
            'shipment_id' => ['nullable', Rule::exists('shipments', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'informations_type' => ['required', 'string', 'max:255', 'in:all,required'],
            'status_id' => ['nullable', Rule::exists('statuses', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'name' => ['required', 'string', 'max:255'],
            'shipment_number' => ['required', 'string', 'max:255', Rule::unique('shipments', 'shipment_number')->where(fn(Builder $query) => $query->where('id', '<>', $this->input('shipment_id')))],
            'packages' => ['required', 'array'],
            'shipment_type_id' => ['required', Rule::exists('shipment_types', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'warehouse_id' => ['required', Rule::exists('warehouses', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))],
            'description' => ['nullable', 'string'],
            'net_weight' => ['nullable', 'numeric'],
            'volumetric_weight' => ['nullable', 'numeric'],
            'cbm' => ['nullable', 'numeric'],
            'length' => ['nullable', 'numeric'],
            'width' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'dollar_amount' => ['nullable', 'numeric'],
            'naira_amount' => ['nullable', 'numeric'],
            'fcfa_amount' => ['nullable', 'numeric'],
            'other_amount' => ['nullable', 'numeric'],
            'total_amount' => ['nullable', 'numeric'],
            'departure_date' => ['nullable', 'date'],
            'arrival_date_nigeria' => ['nullable', 'date'],
            'arrival_date_benin' => ['nullable', 'date'],
            'image' => ['nullable', 'image'],
        ];

        if (!empty($data['status_update'])) {
            $rules = ['status_update' => 'nullable', Rule::exists('statuses', 'id')->where(fn(Builder $query) => $query->whereNotNull('activated_at')->whereNull('deleted_at'))];
        }

        return $rules;
    }
}
