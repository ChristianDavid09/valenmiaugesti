<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advertisement extends Model
{

    public function feline()
    {
        return $this->belongsTo(Feline::class, 'id_feline');
    }

}
