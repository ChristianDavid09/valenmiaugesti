<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cologne extends Model
{
    protected $table = 'colognes';

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
    public function felines()
    {
        return $this->hasMany(Feline::class, 'id_cologne');
    }
    /**
     * Con esta función podemos acceder a los anuncios de una colonia a través de la relación con felinos.
     * Esto es útil para obtener todos los anuncios de una colonia sin tener que hacer una consulta adicional
     * para cada felino.
     * La funcion hasManyThrough() permite acceder a una relación a través de otra relación, por ejemplo, en caso de la base de datos
     * de la aplicación, podemos acceder a los anuncios de una colonia a través de los felinos que pertenecen a esa colonia.
     */
    public function advertisements()
    {
        return $this->hasManyThrough(
            Advertisement::class,
            Feline::class,
            'id_cologne',
            'id_feline',
            'id',
            'id'
        );
    }
}
