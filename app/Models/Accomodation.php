<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'capacity',
        'area_id',
    ];


    public function area()
    {
        return $this->belongsTo(Areas::class);
    }

    public function animals(){
        return $this->hasMany(Animals::class);
    }

}
