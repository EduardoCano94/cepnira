<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $fillable = [
        'alumno_id', 'registrado_por', 'estado',
        'validado', 'observaciones', 'validado_por', 'fecha_validacion',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function registrador()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }

    public function validador()
    {
        return $this->belongsTo(User::class, 'validado_por');
    }
}