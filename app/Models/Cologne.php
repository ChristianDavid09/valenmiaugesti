<?php
/**
 * @author: David Murillo
 * @version: 1.0
 * @since: 05-03-2025
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cologne extends Model
{
    protected $table = 'colognes';
    /**
     * Los atributos que son asignables en masa.
     * Estos son los campos que se pueden llenar directamente
     * al crear o actualizar un modelo de colonia.
     * Esto es útil para evitar la asignación masiva de campos no deseados.
     */
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
    /**
     * Relación uno a muchos con el modelo Feline.
     * Una colonia puede tener muchos felinos asociados.
     * Esto permite acceder a todos los felinos que pertenecen a una colonia específica.
     * Por ejemplo, si queremos obtener todos los felinos de una colonia, podemos usar esta relación.
     */
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
