<?php


namespace App\Http\Requests\ContactDetail;

use App\Rules\UkPhoneNumber;
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
         'contact_email' => ['required', 'string', 'email' => 'email:rfc,dns', 'max:255'],
         'contact_phone' => ['required', new UkPhoneNumber],
         'customer_id' => ['required', 'exists:customers,id'],
      ];
   }
}
