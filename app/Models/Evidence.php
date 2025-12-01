<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evidence extends Model
{
    protected $table = 'evidence';

    protected $fillable = [
        'evidence_id',
        'name',
        'type',
        'incident_id',
        'description',
        'hash',
        'physical_location',
        'acquired_by',
        'acquired_at'
    ];

    protected $casts = [
        'acquired_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }
}