<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'service',
        'month',
        'year',
        'cp_value',
        'm_value',
        'a_value',
        'day_type',
        'day_number'
    ];

    /**
     * Retourne la clé du mois formatée
     *
     * @return string
     */
    public function getMonthKeyAttribute()
    {
        return sprintf("%02d/%d", $this->month, $this->year);
    }
}