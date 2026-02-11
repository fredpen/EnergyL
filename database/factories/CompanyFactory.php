<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Customer;
use App\Models\EnergyConsumption;
use App\Models\Meter;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
   protected $model = Company::class;

   public function definition(): array
   {
      return [
         'name' => $this->faker->name() . 'Energy Ltd',
         'email_verified_at' => now(),
         'email' => $this->faker->safeEmail(),
         'password' => Hash::make('password'),
         'remember_token' => Str::random(10),
      ];
   }

   public function withRelations(): static
   {
      return $this->afterCreating(function ($company) {

         // Create customers
         $customers = Customer::factory()
            ->count(3)
            ->create(['company_id' => $company->id]);

         foreach ($customers as $customer) {

            // Create sites for each customer
            $sites = Site::factory()
               ->count(2)
               ->create([
                  'company_id' => $company->id,
                  'customer_id' => $customer->id,
               ]);


            foreach ($sites as $site) {

               //create meter
               $meter = Meter::factory()
                  ->create([
                     'site_id' => $site->id,
                     'company_id' => $company->id,
                     'customer_id' => $customer->id,
                  ]);


               EnergyConsumption::factory()
                  ->count(5)
                  ->create([
                     'company_id' => $company->id,
                     'customer_id' => $customer->id,
                     'site_id' => $site->id,
                     'meter_id' => $meter->id,
                     'loggedAgainst' => $this->faker->dateTime(),
                  ]);
            }
         }
      });
   }
}
