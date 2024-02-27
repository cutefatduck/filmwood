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
        Schema::create('p_audiovisual_media', function (Blueprint $table) {
            $table->id();

            # Clave foranea de el pais
            $table->unsignedBigInteger('id_country');
            $table->foreign('id_country')->references('id')->on('p_countries')->onDelete('cascade');

            # Clave foranea del tipo audiovisual
            $table->unsignedBigInteger('id_audiovisual_type');
            $table->foreign('id_audiovisual_type')->references('id')->on('p_audiovisual_types')->onDelete('cascade');
            
            # 
            $table->unsignedBigInteger('id_genere');
            $table->foreign('id_genere')->references('id')->on('p_genres')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_audiovisual_media');
    }
};
