<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_user extends Model
{

    use HasFactory;
    
    // Especificaremos el nombre de la tabla de la base de datos a la que hacemos referencia:
    protected $table = 'p_users'; 
    protected $primaryKey = 'id'; // Especificamos la clave primaria personalizada

    // Indicamos los atributos que son modificables:
    protected $fillable = [
        'nombre',
        'email',
        'usuario'
    ];

    // Indicamos a Laravel que no use las columnas created_at y updated_at
    public $timestamps = false;

    // Definimos la clave foránea junto con su respectivo modelo:
    public function role()
    {
        return $this->belongsTo(p_role::class, 'id_rol');
    }

    public function credential()
    {
        return $this->hasOne(p_credential::class, 'id_user');
    }
}
