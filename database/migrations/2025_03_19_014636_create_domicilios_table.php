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
        Schema::create('domicilios', function (Blueprint $table) {
            $table->id('DomicilioID');
            $table->unsignedBigInteger('MunicipioID');
            $table->foreign('MunicipioID')->references('MunicipioID')->on('municipios')->cascadeOnDelete();
            $table->string('Colonia', 70);
            $table->string('Domicilio', 150);
            $table->string('NumExterior', 10);
            $table->string('EntreCalles', 150);
            $table->unsignedBigInteger('UsuarioCreo');
            $table->foreign('UsuarioCreo')->references('id')->on('users')->cascadeOnDelete();
            $table->tinyInteger('Activo');
            $table->date('FechaCreacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
