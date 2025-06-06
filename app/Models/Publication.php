<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //Una publicacion pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
