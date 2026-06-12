<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'statut',
        'priorite',
        'user_id',
        'poste_informatique_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poste()
    {
        return $this->belongsTo(PosteInformatique::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}