<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crearemos la tabla generos junto con sus campos:
        Schema::create('p_genres', function (Blueprint $table) {
            // Creamos la clave primaria de la tabla (Hace referencia a id_genero)
            $table->id();
            $table->string('name_genre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_genres');
    }
};
