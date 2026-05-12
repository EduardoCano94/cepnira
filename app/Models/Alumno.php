<?php

namespace App\Models;

use App\Traits\GeneraNIA;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use GeneraNIA;

    protected $fillable = [
        'ciclo_escolar', 'fecha_cedula', 'nia',
        'apellido_paterno', 'apellido_materno', 'nombre',
        'curp', 'fecha_nacimiento', 'pais_nacimiento',
        'entidad_nacimiento', 'genero', 'discapacidad',
        'tipo_sangre', 'lengua_materna',
    ];

    // Genera el NIA automáticamente antes de crear
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($alumno) {
            if (empty($alumno->nia)) {
                $alumno->nia = self::generarNIA();
            }
        });
    }

    public function padre()
    {
        return $this->hasOne(Padre::class)->where('tipo', 'padre');
    }

    public function madre()
    {
        return $this->hasOne(Padre::class)->where('tipo', 'madre');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class);
    }

    public function documentoProbatorio()
    {
        return $this->hasOne(DocumentoProbatorio::class);
    }

    public function escuela()
    {
        return $this->hasOne(DatoEscuela::class);
    }

    public function expediente()
    {
        return $this->hasOne(Expediente::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->apellido_paterno} {$this->apellido_materno} {$this->nombre}";
    }
}