<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anuncio extends Model
{

    public function felino()
    {
        return $this->belongsTo(Felino::class, 'id_felino');
    }

}
