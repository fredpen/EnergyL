<?php

namespace App\Http\Requests\Customer;

use App\Rules\UkPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
   protected $stopOnFirstFailure;

   public function authorize(): bool
   {
      return true;
   }

   public function rules(): array
   {
      return [
         'name' => ['required'],
         'contact_email' => ['required', 'string', 'email' => 'email:rfc,dns', 'max:255'],
         'contact_phone' => ['required', new UkPhoneNumber],
         'billing_preference' => ['nullable', 'string'],
      ];
   }
}
