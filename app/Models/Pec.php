<?php
// app/Models/Pec.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pec extends Model
{
    protected $table = 'reports';

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
