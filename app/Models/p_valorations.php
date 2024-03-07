<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_valorations extends Model
{

    use HasFactory;
    
    // Especificaremos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_valorations'; 

    // Indicamos los atributos que son modificables:
    protected $fillable = [
        'valoracion',
        'puntuacion',
    ];
    
    // Indicamos a Laravel que no use las columnas created_at y updated_at
    public $timestamps = false;
}
