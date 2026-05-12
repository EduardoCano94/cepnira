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
    Schema::table('alumnos', function (Blueprint $table) {
        $table->date('fecha_cedula')->nullable()->after('ciclo_escolar');
    });
}

public function down(): void
{
    Schema::table('alumnos', function (Blueprint $table) {
        $table->dropColumn('fecha_cedula');
    });
}
};
