<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Felino extends Model
{
    public function anuncios()
    {
        return $this->hasOne(Anuncio::class, 'id_felino');
    }

}
