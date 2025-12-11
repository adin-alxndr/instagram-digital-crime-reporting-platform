<?php
// app/Models/Report.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'report_id',
        'reporter_name',
        'reporter_email',
        'reporter_phone',
        'crime_type',
        'suspect_username',
        'suspect_profile_url',
        'description',
        'evidence_type',
        'evidence_file',
        'is_anonymous',
        'agree',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
