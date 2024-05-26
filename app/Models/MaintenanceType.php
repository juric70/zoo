<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }
}
