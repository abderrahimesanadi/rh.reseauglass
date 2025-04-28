<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuiviQualite extends Model
{
    use HasFactory;
    protected $table = 'suivi_qualites'; 
    protected $fillable = [
        'agent_id',
        'module_id',
        'date_fin_formation',
        'analyse',
        'suivi_qualite_id',
        'numero_dossier',
        'date_traitement_dossier',
        'commentaire'
    ];

    protected $casts = [
        'date_fin_formation' => 'date',
        'date_traitement_dossier' => 'date',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function suiviQualite()
    {
        return $this->belongsTo(User::class, 'suivi_qualite_id');
    }
    public function session()
    {
        return $this->belongsTo(\App\Models\Session::class, 'module_id', 'module_id');
    }
}