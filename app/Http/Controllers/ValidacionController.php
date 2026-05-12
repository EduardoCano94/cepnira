<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;

class ValidacionController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::with('alumno')
            ->where('validado', false)
            ->get();

        return view('validacion.index', compact('expedientes'));
    }

    public function validar(Request $request)
    {
        $ids = $request->input('seleccionados', []);

        Expediente::whereIn('id', $ids)->update([
            'validado'         => true,
            'validado_por'     => auth()->id(),
            'fecha_validacion' => now(),
            'observaciones'    => $request->observaciones,
        ]);

        return back()->with('success', 'Expedientes validados y firmados correctamente.');
    }

    public function rechazar(Request $request)
    {
        $ids = $request->input('seleccionados', []);

        Expediente::whereIn('id', $ids)->update([
            'observaciones' => $request->observaciones,
        ]);

        return back()->with('info', 'Expedientes rechazados con observaciones.');
    }
}