<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiteRequest extends FormRequest
{
    protected $stopOnFirstFailure;

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'owner_id' => ['required', 'exists:users,id'],
            'meter_id' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:gas,electric'],
            'latest_reading' => ['nullable', 'numeric'],
            'last_updated_at' => ['nullable', 'date'],
        ];
    }
}
