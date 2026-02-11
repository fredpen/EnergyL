<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnergyConsumptionFactory extends Factory
{
   public function definition(): array
   {
      return [
         'reading' => $this->faker->randomFloat(2, 10, 5000),
      ];
   }
}
