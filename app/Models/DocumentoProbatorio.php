<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoProbatorio extends Model
{
    protected $table = 'documentos_probatorios';
    protected $fillable = [
        'alumno_id', 'entidad_fed_registro', 'municipio_registro', 'año_registro',
        'tipo_documento', 'num_libro', 'num_acta', 'crip',
        'num_registro_nacional_extranjeros', 'folio_carta',
        'num_juzgado', 'folio_ficha', 'observaciones',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}