<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    // Un mensaje puede tener muchas respuestas
    protected $fillable = [
        'message_id',
        'user_id',
        'content',
    ];
    // Muchas respuestas pertenece a un mensaje
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
