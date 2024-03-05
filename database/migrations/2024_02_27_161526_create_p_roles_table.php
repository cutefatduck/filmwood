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
        Schema::create('p_roles', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id(); 
=======
            $table->id();          
>>>>>>> ffb95d11e724c770c8ba2b19366e8309d2855d8c
            $table->string('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_roles');
    }
};