<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Exception;

class CompanyService
{
   public static function createUser(string $email, string $password, string $name): Company
   {
      $company = Company::query()
         ->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
         ]);

      if (!$company) throw new Exception("Unable to generate company");

      return $company;
   }

   /**
    * @throws Exception
    */
   public function login(string $email, string $password): Company
   {
      $company = Company::findByEmail($email);
      if (!$company) {
         throw new Exception("Invalid Credentials.");
      }

      if (!Hash::check($password, $company->password)) {
         throw new Exception("Invalid Credentials");
      }

      return $company;
   }

   /**
    * @throws Exception
    */
   public static function createToken(Company $company): string
   {
      $token = $company->createToken('api-token')->plainTextToken;
      if ($token) return $token;

      throw new Exception("Unable to generate company");
   }
}
