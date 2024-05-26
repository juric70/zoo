<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'jmbg',
        'date_of_birth',
        'employment_date',
        'position_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public  function tickets()
    {
        return $this->hasMany(Tickets::class);
    }


    public function feeding()  {
        return $this->hasMany(Feeding::class);
    }



}
