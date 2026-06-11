<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //

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
