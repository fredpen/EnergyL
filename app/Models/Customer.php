<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
   use HasFactory;

   protected $guarded = [];

   public function owner(): HasMany
   {
      return $this->hasMany(Company::class, 'company_id');
   }

   public function sites(): HasMany
   {
      return $this->hasMany(Site::class, 'customer_id');
   }

   public function meters(): HasMany
   {
      return $this->hasMany(Meter::class, 'customer_id');
   }


}
