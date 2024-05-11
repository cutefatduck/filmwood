<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_genres extends Model
{

    use HasFactory;
    
    // Especificaremos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_genres'; 

    // Indicamos los atributos que son modificables:
    protected $fillable = [
        'name_genre'
    ];

    // Indicamos a Laravel que no use las columnas created_at y updated_at
    public $timestamps = false; 

    public function mediaShows()
    {
        return $this->belongsToMany(p_media_show::class, 'p_media_show_genres', 'id_genre', 'id_media_show');
    }
}