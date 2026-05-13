<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('ciclo_escolar');
            $table->string('nia')->unique()->nullable();
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombre');
            $table->string('curp', 18)->unique();
            $table->date('fecha_nacimiento');
            $table->string('pais_nacimiento')->default('México');
            $table->string('entidad_nacimiento')->nullable();
            $table->enum('genero', ['H', 'M'])->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('tipo_sangre', 5)->nullable();
            $table->string('lengua_materna')->nullable();
            $table->date('fecha_cedula')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};  