<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UkPhoneNumber implements ValidationRule
{
   public function validate(string $attribute, mixed $value, Closure $fail): void
   {
      // Remove spaces, dashes, parentheses
      $phone = preg_replace('/[\s\-\(\)]/', '', $value);

      // Accept formats:
      // +447XXXXXXXXX
      // 07XXXXXXXXX
      // 00447XXXXXXXXX
      $pattern = '/^(?:\+44|0044|0)7\d{9}$/';

      if (!preg_match($pattern, $phone)) {
         $fail('The :attribute must be a valid UK mobile phone number.');
      }
   }
}
