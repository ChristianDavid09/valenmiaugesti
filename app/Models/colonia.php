<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    protected $table = 'colonias';

    protected $fillable = [
        'name',
        'id_ref_com',
        'province',
        'adress',
        'description',
        'phone',
        'photo',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
