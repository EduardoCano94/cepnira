<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatoEscuela extends Model
{
    protected $table = 'dato_escuelas';

    protected $fillable = [
        'alumno_id', 'nombre_escuela', 'cct',
        'turno', 'grado', 'grupo', 'ze',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}