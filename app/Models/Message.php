<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    //Un anuncio puede tener muchos mensajes
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'id_adver');
    }
    // Un mensaje pertenece a un adoptante
    public function adopter()
    {
        return $this->belongsTo(Adopter::class, 'id_adopter');
    }
    // Un mensaje pertenece a una colonia
    public function cologne()
    {
        return $this->belongsTo(Cologne::class, 'id_cologne');
    }
    // Un mensaje puede tener muchas respuestas
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

}
