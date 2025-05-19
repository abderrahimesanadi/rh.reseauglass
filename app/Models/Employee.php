<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date_embauche',
    ];

    protected $casts = [
        'date_embauche' => 'date',
    ];

    /**
     * Get the leave record associated with the employee.
     */
    public function leaveRecord()
    {
        return $this->hasOne(LeaveRecord::class);
    }

    /**
     * Get the monthly leaves for the employee.
     */
    public function monthlyLeaves()
    {
        return $this->hasMany(MonthlyLeave::class);
    }
    

    /**
     * Calculate employee's seniority in months.
     *
     * @return int
     */
    public function getAncienneteAttribute()
    {
        return $this->date_embauche->diffInMonths(Carbon::now());
    }

    /**
     * Calculate employee's earned leave.
     *
     * @return float
     */
   // Dans le modèle Employee.php
public function getCongesAcquisAttribute()
{
    // Votre logique de calcul des congés acquis
    // Par exemple, 2.5 jours par mois travaillé
    $embauche = Carbon::parse($this->date_embauche);
    $now = Carbon::now();
    $monthsWorked = $embauche->diffInMonths($now);
    
    return $monthsWorked * 1.5; // Ou votre formule de calcul
}


    /**
     * Get employee's taken leave.
     *
     * @return float
     */
    public function getCongesPrisAttribute()
    {
        return $this->leaveRecord ? $this->leaveRecord->conges_pris : 0;
    }

    /**
     * Calculate employee's remaining leave.
     *
     * @return float
     */
   // Dans le modèle Employee.php
// Nouvelle méthode pour calculer les congés restants pour un mois spécifique
public function getCongesRestantsForMonth($monthKey)
{
    // Récupérer les congés acquis
    $congesAcquis = $this->conges_acquis;
    
    // Récupérer les congés pris totaux
    $congesPris = $this->conges_pris;
    
    // Récupérer les CP du mois spécifié
    $cpMonth = $this->monthlyLeaves()
                    ->where('month_key', $monthKey)
                    ->first()
                    ->leave_value ?? 0;
    
    // Calculer les congés restants
    return $congesAcquis - ($congesPris + $cpMonth);
}

// La méthode d'accesseur existante peut utiliser la nouvelle méthode
public function getCongesRestantsAttribute()
{
    $currentMonthKey = sprintf("%02d/%d", date('n'), date('Y'));
    return $this->getCongesRestantsForMonth($currentMonthKey);
}
    /**
     * Get a specific monthly leave value.
     *
     * @param string $monthKey Format: MM/YYYY
     * @return float
     */
    public function getMonthlyLeaveValue($monthKey)
    {
        $monthlyLeave = $this->monthlyLeaves()->where('month_key', $monthKey)->first();
        return $monthlyLeave ? $monthlyLeave->leave_value : 0;
    }
}