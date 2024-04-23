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
        Schema::create('p_valorations', function (Blueprint $table) {

            // Creamos la clave primaria de la tabla:
            $table->id();

            // Creamos la clave foránea del id del usuario:
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

            // Creamos la clave foránea del id de la media show:
            $table->unsignedBigInteger('id_media_show');
            $table->foreign('id_media_show')->references('id')->on('p_media_show')->onDelete('cascade');

            // Creamos el resto de campos de la tabla:
            $table->integer('puntuacion');
            $table->string('valoracion');
                        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_valorations');
    }
};
