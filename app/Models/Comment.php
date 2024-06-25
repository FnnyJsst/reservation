<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Permet de créer facilement des instances du modèle
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
