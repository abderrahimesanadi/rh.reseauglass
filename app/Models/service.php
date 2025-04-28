<?php

namespace App\Models;

use CreateAgentsTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'couleur'];

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}