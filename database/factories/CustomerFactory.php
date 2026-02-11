<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
   public function definition(): array
   {
      return [
         'name' => $this->faker->company(),
         'contact_email' => $this->faker->safeEmail(),
         'contact_phone' => '07123456789',
         'billing_preference' => $this->faker->randomElement(['PDF', 'CSV', 'EDI']),
      ];
   }
}
