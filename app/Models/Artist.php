<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    //Permet de créer facilement des instances du modèle
    use HasFactory;

    protected $fillable = ['name'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
