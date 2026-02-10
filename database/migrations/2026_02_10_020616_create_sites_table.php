<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('meter_id');
            $table->enum('type', ['gas', 'electric']);
            $table->decimal('latest_reading', 10, 2)->nullable();
            $table->timestamp('last_updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
