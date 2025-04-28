<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'service_id', 'nombre_formation_suivi'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function sessions()
{
    return $this->belongsToMany(Session::class);
}
public function suiviQualites()
{
    return $this->hasMany(SuiviQualite::class);
}

}