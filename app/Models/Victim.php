<?php
// app/Models/Victim.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Victim extends Model
{
    protected $table = 'reports';

    protected $casts = [
        'created_at' => 'datetime',
    ];
}