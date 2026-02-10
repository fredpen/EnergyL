<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteRequest extends FormRequest
{
    protected $stopOnFirstFailure;

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'meter_id' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'in:gas,electric'],
            'latest_reading' => ['sometimes', 'numeric'],
            'last_updated_at' => ['sometimes', 'date'],
        ];
    }
}
