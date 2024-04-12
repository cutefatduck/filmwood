<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_media_show extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_country',
        'id_media_show_type',
        'id_pemi',
        'nombre',
        'duracion',
        'actores',
        'sinopsis_corta',
        'sinopsis',
        'portada_img',
        'idioma',
        'directores',
        'sinopsis',
        'trailer',
        'fecha_media_show',
        'saga',
        'episodios',
        'temporadas',
    ];

    // Especificaremos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_media_show';
    
    // Definimos las claves foráneas junto con su respectivo modelo:
    public function country()
    {
        return $this->belongsTo(p_country::class, 'id_country');
    }

    public function mediaShowType()
    {
        return $this->belongsTo(p_media_show_type::class, 'id_media_show_type');
    }


    public function pemi()
    {
        return $this->belongsTo(p_pemi::class, 'id_pemi');
    }

    public function genres()
    {
        return $this->belongsToMany(p_genres::class, 'p_media_show_genres', 'id_media_show', 'id_genre');
    }
}
