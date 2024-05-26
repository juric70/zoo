<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_type_id',
        'employee_id',
        'date',
        'description',
    ];


    public function maintenance_type()
    {
        return $this->belongsTo(MaintenanceType::class);
    }
}
