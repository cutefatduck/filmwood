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
        // Creamos la tabla usuarios:
        Schema::create('p_users', function (Blueprint $table) {

            // Creamos la clave primaria de la tabla (Hace referencia a id_usuario)
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('name');
            
            # Clave foranea del rol
            $table->unsignedBigInteger('id_rol');
            $table->foreign('id_rol')->references('id')->on('p_roles')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_users');
    }
};
