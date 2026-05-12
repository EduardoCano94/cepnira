<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Expediente;

class DashboardController extends Controller
{
    public function index()
    {
        // Tarjetas resumen
        $totalAlumnos  = Alumno::count();
        $pendientes    = Expediente::where('validado', false)->count();
        $validados     = Expediente::where('validado', true)->count();
        $recientes     = Expediente::with('alumno.escuela')
                            ->latest()->take(8)->get();

        // Por género
        $hombres = Alumno::where('genero', 'H')->count();
        $mujeres = Alumno::where('genero', 'M')->count();

        // Por grado
        $porGrado = Alumno::join('dato_escuelas', 'alumnos.id', '=', 'dato_escuelas.alumno_id')
            ->selectRaw('dato_escuelas.grado, COUNT(*) as total')
            ->groupBy('dato_escuelas.grado')
            ->orderBy('dato_escuelas.grado')
            ->pluck('total', 'dato_escuelas.grado');

        // Por turno
        $porTurno = Alumno::join('dato_escuelas', 'alumnos.id', '=', 'dato_escuelas.alumno_id')
            ->selectRaw('dato_escuelas.turno, COUNT(*) as total')
            ->groupBy('dato_escuelas.turno')
            ->pluck('total', 'dato_escuelas.turno');

        // Por ciclo escolar
        $porCiclo = Alumno::selectRaw('ciclo_escolar, COUNT(*) as total')
            ->groupBy('ciclo_escolar')
            ->orderBy('ciclo_escolar', 'desc')
            ->pluck('total', 'ciclo_escolar');

        return view('dashboard', compact(
            'totalAlumnos', 'pendientes', 'validados', 'recientes',
            'hombres', 'mujeres', 'porGrado', 'porTurno', 'porCiclo'
        ));
    }
}