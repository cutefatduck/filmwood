<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{

    use HasFactory;

    // Especificaremos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_media_show'; 
    
    protected $fillable = [
        'nombre',
        'duracion',
        'actores',
        'sinopsis_corta',
        'sinopsis_larga',
        'portada_img',
        'idioma',
        'directores',
        'sinopsis',
        'trailer',
        'fecha_media_show'
    ];

    // Indicamos a Laravel que no use las columnas created_at y updated_at
    public $timestamps = false;
}