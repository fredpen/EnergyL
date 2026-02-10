<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Site extends Model
{
    protected $fillable = [
        'owner_id',
        'meter_id',
        'type',
        'latest_reading',
        'last_updated_at',
    ];

    protected $casts = [
        'last_updated_at' => 'datetime',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function meters(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Meter::class);
    }


}

