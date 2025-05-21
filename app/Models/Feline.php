<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feline extends Model
{
    public function advertisement()
    {
        return $this->hasOne(Advertisement::class, 'id_feline');
    }
    public function cologne()
    {
        return $this->belongsTo(Cologne::class, 'id_cologne');
    }

}
