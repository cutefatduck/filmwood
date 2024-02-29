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
        Schema::create('p_games', function (Blueprint $table) {
            $table->id();

            # Clave foranea de la tabla media_show:
            $table->unsignedBigInteger('id_media_show');
            $table->foreign('id_media_show')->references('id')->on('p_media_show')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_games');
    }
};