<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function response()
    {
        return $this->belongsTo(User::class, 'response_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
