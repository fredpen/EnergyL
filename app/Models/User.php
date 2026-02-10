<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function contactDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ContactDetail::class);
    }

    public function sites(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Site::class, 'owner_id');
    }

    public function meters(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Meter::class);
    }
}
