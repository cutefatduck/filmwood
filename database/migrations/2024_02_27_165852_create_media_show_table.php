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
        Schema::create('media_show', function (Blueprint $table) {

            // Creamos la clave primaria de la tabla:
            $table->id();

            // Creamos la clave foránea del país:
            $table->unsignedBigInteger('id_country');
            $table->foreign('id_country')->references('id')->on('countries')->onDelete('cascade');

            // Creamos la clave foránea del tipo de media show:
            $table->unsignedBigInteger('id_media_show_type');
            $table->foreign('id_media_show_type')->references('id')->on('media_show_type')->onDelete('cascade');

            // Creamos la clave foránea del pemi:
            $table->unsignedBigInteger('id_pemi');
            $table->foreign('id_pemi')->references('id')->on('pemis')->onDelete('cascade');

            // Creamos el resto de campos de la tabla:
            $table->string('nombre');
            $table->time('duracion');
            $table->text('actores');
            $table->text('sinopsis_corta');
            $table->string('portada_img');
            $table->string('idioma');
            $table->text('directores');
            $table->text('sinopsis');
            $table->date('fecha_media_show');
            $table->string('trailer')->nullable();
            $table->string('saga')->nullable();
            $table->integer('episodios')->nullable();
            $table->integer('temporadas')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_show');
    }
};
