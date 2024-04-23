<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_visualized extends Model
{
    use HasFactory;

    // Especificaremos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_visualized';

    // Indicamos los atributos que son modificables:
    protected $fillable = [
        'id_user',
        'id_media_show'
    ];

    // Indicamos a Laravel que no use las columnas created_at y updated_at
    public $timestamps = false;

    // Definimos las claves foráneas junto con su respectivo modelo:
    public function id_user()
    {
        return $this->belongsTo(p_user::class, 'id_user');
    }
    
    public function id_media_show()
    {
        return $this->belongsTo(p_media_show::class, 'id_media_show');
    }
}
