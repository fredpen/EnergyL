<?php


namespace App\Http\Requests\ContactDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactDetailRequest extends FormRequest
{
    protected $stopOnFirstFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ];
    }
}
