<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Pelicula
{

    use HasFactory;
    
    // Especificaremos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_media_show'; 

    // Indicamos los atributos que son modificables:
    protected $fillable = [
        'episodios',
        'temporadas'
    ];
}
