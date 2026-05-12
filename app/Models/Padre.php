<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    protected $fillable = [
        'alumno_id', 'tipo',
        'apellido_paterno', 'apellido_materno', 'nombre',
        'curp', 'fecha_nacimiento', 'pais_nacimiento', 'nivel_estudios',
        'vive_con_alumno', 'es_tutor', 'es_finado',
        'pais_residencia', 'entidad', 'municipio', 'localidad',
        'cp', 'colonia', 'calle', 'num_ext', 'num_int',
        'tel_fijo', 'tel_celular', 'email', 'ocupacion', 'horario',
        'tel_trabajo', 'ext_trabajo', 'email_trabajo',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}