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
    Schema::create('dato_escuelas', function (Blueprint $table) {
       $table->id();
$table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
$table->string('nombre_escuela');
$table->string('nivel')->default('primaria');
$table->string('cct')->nullable();
$table->enum('turno', ['matutino', 'vespertino', 'nocturno'])->nullable();
$table->string('grado');
$table->string('grupo')->nullable();
$table->string('ze')->nullable();
$table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dato_escuelas');
    }
};
