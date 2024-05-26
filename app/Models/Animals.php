<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
       'date_of_birth',
       'country_of_origin',
       'special_notes',
       'accommodation_id',
       'animal_type_id',
    ];


    public function accommodation()
    {
        return $this->belongsTo(Accomodation::class);
    }

    public function animal_type()
    {
        return $this->belongsTo(AnimalTypes::class);
    }
}
