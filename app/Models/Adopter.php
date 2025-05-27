<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adopter extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function adopter()
    {
        return $this->hasOne(Adopter::class);
    }

}
