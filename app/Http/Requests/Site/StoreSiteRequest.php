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
         'name' => ['required', 'string', 'max:255'],
         'meter_id' => ['required', 'string', 'max:255'],
         'customer_id' => ['required', 'exists:customers,id'],
      ];
   }
}
