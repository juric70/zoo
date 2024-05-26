<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function accomodations()
    {
        return $this->hasMany(Accomodation::class);
    }
}
