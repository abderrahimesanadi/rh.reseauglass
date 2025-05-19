<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'month_key',
        'leave_value',
    ];

    /**
     * Get the employee that owns the monthly leave.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}