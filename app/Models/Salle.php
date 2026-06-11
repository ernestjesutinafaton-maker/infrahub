<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    //


    public function postes()
{
    return $this->hasMany(PosteInformatique::class);
}

}
