<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adopter extends Model
{
    //Un usuario tiene un id_user (relacion inversa o N:1)
    // Un adoptante pertecene a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
