<?php


namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillingPreferenceRequest extends FormRequest
{
   protected $stopOnFirstFailure;

   public function authorize(): bool
   {
      return true;
   }

   public function rules(): array
   {
      return [
         'billing_preference' => ['required', 'string'],
         'customer_id' => ['required', 'exists:customers,id'],
      ];
   }
}
