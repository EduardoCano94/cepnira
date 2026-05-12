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
    Schema::create('alumnos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellido_paterno');
        $table->string('apellido_materno');
        $table->string('curp', 18)->unique();
        $table->date('fecha_nacimiento');
        $table->string('direccion');
        $table->enum('nivel', ['preescolar', 'primaria', 'secundaria']);
        $table->string('grado');
        $table->string('ciclo_escolar'); // ej. "2025-2026"
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
