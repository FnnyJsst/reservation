<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    //Permet de créer facilement des instances du modèle
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
