<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //Permet de créer facilement des instances du modèle
    use HasFactory;

    // Peuvent être modifiés avec Create et Update
    protected $fillable = [
        'title',
        'description',
        'city_id',
        'venue_id',
        'date',
        'artists'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
