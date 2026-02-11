<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
   {
      Schema::create('energy_consumptions', function (Blueprint $table) {
         $table->id();

         $table->decimal('reading');

         $table->timestamp('loggedAgainst')
            ->index();

         $table->foreignId('site_id')
            ->index()
            ->constrained('sites')
            ->cascadeOnDelete();

         $table->foreignId('meter_id')
            ->index()
            ->constrained('meters')
            ->cascadeOnDelete();

         $table->foreignId('company_id')
            ->index()
            ->constrained('companies')
            ->cascadeOnDelete();

         $table->foreignId('customer_id')
            ->constrained('customers')
            ->cascadeOnDelete();

         $table->timestamps();
      });
   }

   public function down(): void
   {
      Schema::dropIfExists('energy_consumptions');
   }
};
