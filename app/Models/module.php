<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $fillable = [
        'service',
        'titre',
        'competences',
        'objectifs'
    ];

    // Relationship with Service if needed
    public function serviceRelation()
    {
        return $this->belongsTo(Service::class, 'service', 'nom');
    }
    public function sessions()
{
    return $this->hasMany(Session::class);
}
public function suiviQualites()
    {
        return $this->hasMany(SuiviQualite::class);
    }
   
}