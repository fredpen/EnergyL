<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MeterFactory extends Factory
{
   public function definition(): array
   {
      return [
         'type' => $this->faker->randomElement(['gas', 'electric', 'solar', 'wind']),
         'meter_id' => strtoupper($this->faker->bothify('MTR-#####')),
      ];
   }
}
