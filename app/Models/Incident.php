<?php
// app/Models/Victim.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Incident extends Model
{
    protected $table = 'incidents';

    protected $fillable = [
        'incident_id',
        'victim_name',
        'victim_contact',
        'case_type',
        'incident_date',
        'location',
        'summary',
        'reporter',
        'status'
    ];

    protected $casts = [
        'incident_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function evidence(): HasMany
    {
        return $this->hasMany(Evidence::class);
    }
}