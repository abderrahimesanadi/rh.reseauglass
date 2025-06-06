<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'conges_pris',
    ];

    /**
     * Get the employee that owns the leave record.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}