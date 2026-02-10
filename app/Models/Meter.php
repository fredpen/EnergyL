<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    protected $fillable = [
        'site_id',
        'meter_id',
        'type',
        'latest_reading',
        'last_updated_at',
    ];

    protected $casts = [
        'last_updated_at' => 'datetime',
    ];

    public function site(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
