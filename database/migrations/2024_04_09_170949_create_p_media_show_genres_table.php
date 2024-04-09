<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('p_media_show_genre', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_media_show')->unsigned();
            $table->bigInteger('id_genre')->unsigned();
            
            // Definición de claves foráneas
            $table->foreign('id_media_show')->references('id')->on('p_media_show');
            $table->foreign('id_genre')->references('id')->on('p_genres');
        });
    }

    public function down()
    {
        Schema::dropIfExists('p_media_show_genre');
    }
};
