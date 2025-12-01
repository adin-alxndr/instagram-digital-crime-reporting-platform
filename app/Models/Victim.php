<?php
// app/Models/Victim.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Victim extends Model
{
    protected $table = 'victims';

    protected $fillable = [
        'name',
        'organization',
        'contact',
        'role'
    ];

    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class, 'victim_name', 'name');
    }
}