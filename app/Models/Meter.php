<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meter extends Model
{
   use HasFactory;

   protected $guarded = [];

   public function owner(): BelongsTo
   {
      return $this->belongsTo(Company::class, 'company_id');
   }

   public function customer(): BelongsTo
   {
      return $this->belongsTo(Customer::class, 'customer_id');
   }

   public function energyConsumption(): HasMany
   {
      return $this->hasMany(EnergyConsumption::class, 'customer_id');
   }

}

