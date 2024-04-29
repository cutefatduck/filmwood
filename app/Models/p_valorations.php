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
        'id_user',
        'id_media_show',
        'valoracion',
        'puntuacion',
        'recomendacion'
    ];

    // Definimos las claves foráneas junto con su respectivo modelo:
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
        
    public function id_media_show()
    {
        return $this->belongsTo(p_media_show::class, 'id_media_show');
    }
}