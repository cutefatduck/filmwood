<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_game extends Model
{
    use HasFactory;

    // Especificamos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_games'; 
    
    // Indicamos los atributos que son modificables:
    protected $fillable = [
        'id_media_show',
    ];

    // Indicamos a Laravel que no use las columnas created_at y updated_at
    public $timestamps = false;

    // Definimos la clave foránea junto con su respectivo modelo:
    public function mediaShow()
    {
        return $this->belongsTo(p_media_show::class, 'id_media_show');
    }
}
