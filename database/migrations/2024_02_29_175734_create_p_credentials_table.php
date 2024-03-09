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
        Schema::create('p_credentials', function (Blueprint $table) {

            // Creamos la clave primaria de la tabla:
            $table->id();

            // Creamos la clave foránea del id del usuario:
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('p_users')->onDelete('cascade');

            // Creamos el otro campo que falta de la tabla:
            $table->string('password');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_credentials');
    }
};