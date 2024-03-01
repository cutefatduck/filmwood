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
        // Crearemos la tabla sobre el tipo de media_show (Peli o serie) junto con su campo:
        Schema::create('p_media_show_type', function (Blueprint $table) {
            // Creamos la clave primaria de la tabla (Hace referencia a id_tipo_media_show)
            $table->id();
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_media_show_type');
    }
};
