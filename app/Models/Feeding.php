<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeding extends Model
{
    use HasFactory;

    protected $fillable=[
        'employee_id',
        'food_id',
        'date',
        'quantity',
    ];

    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }



}
