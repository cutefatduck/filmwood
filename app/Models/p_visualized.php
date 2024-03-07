<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_visualized extends Model
{
    use HasFactory;

    // Indicamos a Laravel que no use las columnas created_at y updated_at
    public $timestamps = false; 
}
