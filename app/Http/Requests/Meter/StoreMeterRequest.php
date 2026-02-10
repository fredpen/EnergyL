<?php

namespace App\Http\Requests\Meter;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeterRequest extends FormRequest
{
    protected $stopOnFirstFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_id' => ['required', 'exists:sites,id'],
            'meter_id' => ['required', 'string', 'unique:meters,meter_id'],
            'type' => ['required', 'in:gas,electric'],
            'latest_reading' => ['nullable', 'numeric'],
            'last_updated_at' => ['nullable', 'date'],
        ];
    }
}
