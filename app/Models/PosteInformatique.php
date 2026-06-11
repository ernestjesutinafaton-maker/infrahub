<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosteInformatique extends Model
{
    //

    public function salle()
{
    return $this->belongsTo(Salle::class);
}

public function tickets()
{
    return $this->hasMany(Ticket::class);
}

}
