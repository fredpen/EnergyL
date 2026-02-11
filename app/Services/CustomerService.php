<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;

class CustomerService
{
   /**
    * @throws Exception
    */
   public function create(Company $company, string $name, string $email, string $phone, string $preference): Customer
   {
      $customer = $company->customers()
         ->create([
            'name' => $name,
            'contact_email' => $email,
            'contact_phone' => $phone,
            'billing_preference' => $preference,
         ]);

      if (!$customer) throw new Exception("Unable to save site");

      return $customer;
   }

   public function fetchByCompany(Company $company): LengthAwarePaginator
   {
      return $company->customers()
         ->latest()
         ->paginate(10);
   }

   public function fetchByCustomerId(Company $company, string $customerId): Customer|null
   {
      return $company->customers()
         ->where('id', $customerId)
         ->first();
   }

   public static function updateContact(Company $company, string $customerId, string $email, string $phone): void
   {
      $company->customers()
         ->where('id', $customerId)
         ->update(['contact_email' => $email, 'contact_phone' => $phone]);
   }


   public static function manageBillingPreference(Company $company, string $customerId, string $billingPreference): void
   {
      $company->customers()
         ->where('id', $customerId)
         ->update(['billing_preference' => $billingPreference]);
   }
}
