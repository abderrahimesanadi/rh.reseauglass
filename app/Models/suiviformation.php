<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuiviFormation extends Model
{
    protected $table = 'suivi_formation';
    
    protected $fillable = [
        'session_id',
        'agent_id',
        'statut'
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}