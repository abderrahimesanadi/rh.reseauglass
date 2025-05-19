<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongeAgent extends Model
{
    use HasFactory;
    
    protected $table = 'conge_agents';
    
    protected $fillable = [
        'agent_id',
        'service',
        'nom',
        'prenom',
        'cp_total',
        'date_suivi',
        'jour_type', // 'L', 'M', 'ME', 'J', 'V', 'SAM', 'DIM'
        'status', // 'C' (congé), 'A' (absent), 'M' (malade)
    ];
    
    // Relation avec l'agent (si vous avez un modèle Agent)
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }

    
    // Méthode pour obtenir le total de congés par mois
    public static function getTotalCongesByMonth($agent_id, $month, $year)
    {
        return self::where('agent_id', $agent_id)
            ->whereMonth('date_suivi', $month)
            ->whereYear('date_suivi', $year)
            ->where('status', 'C')
            ->count();
    }
    
    // Méthode pour obtenir tous les congés d'un mois
    public static function getCongesByMonth($month, $year)
    {
        return self::whereMonth('date_suivi', $month)
            ->whereYear('date_suivi', $year)
            ->orderBy('service')
            ->orderBy('nom')
            ->orderBy('date_suivi')
            ->get();
    }
}