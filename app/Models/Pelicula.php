<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends p_media_show
{
    use HasFactory;

    // Indicamos los atributos que son modificables:
    protected $fillable = [
        'saga',
    ];

    // Especificamos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_media_show';

    // Indicamos a Laravel que no use las columnas created_at y updated_at
    public $timestamps = false;
}
