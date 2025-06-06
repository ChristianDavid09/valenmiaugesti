<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feline extends Model
{
    // Un felino pertenece a un anuncio
    public function advertisement()
    {
        return $this->hasOne(Advertisement::class, 'id_feline');
    }
    // Un felino es parte de una colonia
    public function cologne()
    {
        return $this->belongsTo(Cologne::class, 'id_cologne');
    }

}
