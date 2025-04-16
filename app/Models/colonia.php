<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    protected $table = 'colonias';

    protected $fillable = [
        'nombre',
        'id_ref_com',
        'provincia',
        'direccion',
        'descripcion',
        'telefono_contacto',
        'foto',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
