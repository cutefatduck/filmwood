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
        Schema::create('p_visualized', function (Blueprint $table) {
            $table->id();

            # Clave foranea de el cliente
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('p_users')->onDelete('cascade');

            # Clave foranea de el cliente
            $table->unsignedBigInteger('id_audiovisual_media');
            $table->foreign('id_audiovisual_media')->references('id')->on('p_audiovisual_media')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_visualized');
    }
};
