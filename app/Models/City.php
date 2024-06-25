<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //Permet de créer facilement des instances du modèle
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function venues()
    {
        return $this->hasMany(Venue::class);
    }
}
