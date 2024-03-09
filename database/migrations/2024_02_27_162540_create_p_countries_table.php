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

        Schema::create('p_countries', function (Blueprint $table) {
            
            // Creamos la clave primaria de la tabla:
            $table->id();

            // Creamos el resto de campos de la tabla:
            $table->string('nomenclature');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_countries');
    }
};
