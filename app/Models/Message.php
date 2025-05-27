<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class, 'id_adver');
    }

    public function adopter()
    {
        return $this->belongsTo(Adopter::class, 'id_adopter');
    }

    public function cologne()
    {
        return $this->belongsTo(Cologne::class, 'id_cologne');
    }
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

}
