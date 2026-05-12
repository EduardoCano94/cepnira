<?php

namespace App\Traits;

use App\Models\Alumno;

trait GeneraNIA
{
    public static function generarNIA(): string
    {
        $año = date('Y');
        $prefijo = "CEPNIRA-{$año}-";

        // Busca el último NIA de este año
        $ultimo = Alumno::where('nia', 'like', "{$prefijo}%")
            ->orderBy('nia', 'desc')
            ->value('nia');

        if ($ultimo) {
            // Extrae el número y lo incrementa
            $numero = (int) substr($ultimo, strlen($prefijo));
            $siguiente = $numero + 1;
        } else {
            $siguiente = 1;
        }

        return $prefijo . str_pad($siguiente, 4, '0', STR_PAD_LEFT);
    }
}