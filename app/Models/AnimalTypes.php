<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'feeding_type',
    ];

    public function animals(){
        return $this->hasMany(Animals::class);
    }
}
