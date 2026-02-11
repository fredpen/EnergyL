<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Authenticatable
{
   use HasApiTokens, HasFactory;

   protected $table = 'companies';
   protected $fillable = ['name', 'email', 'password'];
   protected $hidden = ['password', 'remember_token'];


   protected function casts(): array
   {
      return [
         'email_verified_at' => 'datetime',
         'password' => 'hashed',
      ];
   }


   public function sites(): HasMany
   {
      return $this->hasMany(Site::class, 'company_id');
   }
   public function meters(): HasMany
   {
      return $this->hasMany(Meter::class, 'company_id');
   }
   public function customers(): HasMany
   {
      return $this->hasMany(Customer::class, 'company_id');
   }

   public static function findByEmail(string $email): self|null
   {
      return self::query()
         ->where('email', $email)
         ->select(['id', 'password', 'name', 'email'])
         ->first();
   }


}
