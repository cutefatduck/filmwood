<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media_show_genres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_media_show')->unsigned();
            $table->bigInteger('id_genre')->unsigned();
            
            // Definición de claves foráneas
            $table->foreign('id_media_show')->references('id')->on('media_show');
            $table->foreign('id_genre')->references('id')->on('genres');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_show_genres');
    }
};