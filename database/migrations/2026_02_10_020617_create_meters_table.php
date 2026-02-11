<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
   {
      Schema::create('meters', function (Blueprint $table) {

         $table->id();

         $table->enum('type', ['gas', 'electric', 'solar', 'wind']);

         $table->string('meter_id')->index();

         $table->timestamps();

         $table->foreignId('site_id')
            ->index()
            ->constrained('sites')
            ->cascadeOnDelete();

         $table->foreignId('company_id')
            ->index()
            ->constrained('companies')
            ->cascadeOnDelete();

         $table->foreignId('customer_id')
            ->constrained('customers')
            ->cascadeOnDelete();

      });
   }

   public function down(): void
   {
      Schema::dropIfExists('meters');
   }
};
