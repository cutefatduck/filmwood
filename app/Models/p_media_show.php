<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_media_show extends Model
{
    use HasFactory;

    // Indicamos los atributos que son modificables:
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
    
    // Definimos las claves foráneas junto con su respectivo modelo:
    public function country()
    {
        return $this->belongsTo(p_country::class, 'id_country');
    }

    public function mediaShowType()
    {
        return $this->belongsTo(p_media_show_type::class, 'id_media_show_type');
    }

    public function genre()
    {
        return $this->belongsTo(p_genres::class, 'id_genere');
    }

    public function pemi()
    {
        return $this->belongsTo(p_pemi::class, 'id_pemi');
    }
}
