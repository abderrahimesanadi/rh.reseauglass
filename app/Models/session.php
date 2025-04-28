<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'date_formation',
        'module_id',
        'nombre_agents'
    ];

    // Relation avec le module
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // Relation avec les agents
    public function agents()
    {
        return $this->belongsToMany(Agent::class);
    }
    public function suiviQualites()
{
    return $this->hasMany(SuiviQualite::class);
}
}