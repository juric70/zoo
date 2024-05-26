<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'sale_date',
        'employee_id',
        'visit_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

}
