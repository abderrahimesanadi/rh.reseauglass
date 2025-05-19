<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentRib extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id',
        'rib',
        'status',
    ];

    /**
     * Obtenir l'agent associé à ce RIB.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}