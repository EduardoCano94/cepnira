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
    Schema::create('padres', function (Blueprint $table) {
        $table->id();
        $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade');
        $table->enum('tipo', ['padre', 'madre']);
        $table->string('apellido_paterno');
        $table->string('apellido_materno')->nullable();
        $table->string('nombre');
        $table->string('curp', 18)->nullable();
        $table->date('fecha_nacimiento')->nullable();
        $table->string('pais_nacimiento')->nullable();
        $table->string('nivel_estudios')->nullable();
        $table->boolean('vive_con_alumno')->default(true);
        $table->boolean('es_tutor')->default(false);
        $table->boolean('es_finado')->default(false);
        $table->string('pais_residencia')->nullable();
        $table->string('entidad')->nullable();
        $table->string('municipio')->nullable();
        $table->string('localidad')->nullable();
        $table->string('cp', 10)->nullable();
        $table->string('colonia')->nullable();
        $table->string('calle')->nullable();
        $table->string('num_ext')->nullable();
        $table->string('num_int')->nullable();
        $table->string('tel_fijo')->nullable();
        $table->string('tel_celular')->nullable();
        $table->string('email')->nullable();
        $table->string('ocupacion')->nullable();
        $table->string('horario')->nullable();
        $table->string('tel_trabajo')->nullable();
        $table->string('ext_trabajo')->nullable();
        $table->string('email_trabajo')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padres');
    }
};
