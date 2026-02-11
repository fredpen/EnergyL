<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up(): void
   {
      Schema::create('customers', function (Blueprint $table) {
         $table->id();

         $table->string('name');

         $table->string('contact_email');

         $table->string('contact_phone');

         $table->enum('billing_preference', ['PDF', 'CSV', 'EDI']);

         $table->foreignId('company_id')
            ->index()
            ->constrained('companies')
            ->cascadeOnDelete();

         $table->timestamps();
      });
   }


   public function down(): void
   {
      Schema::dropIfExists('customers');
   }
};
