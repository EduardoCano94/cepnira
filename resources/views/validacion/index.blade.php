@extends('layouts.app')
@section('titulo', 'Validación de Expedientes')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Validación y Firma de Expedientes</h2>
        <p class="text-gray-500 text-sm mt-1">Expedientes pendientes de autorización</p>
    </div>

    @if($expedientes->isEmpty())
        <div class="bg-white rounded-xl shadow p-8 text-center text-gray-400">
            No hay expedientes pendientes de validación.
        </div>
    @else
    <form method="POST" action="{{ route('validacion.validar') }}">
    @csrf

        <div class="bg-white rounded-xl shadow overflow-hidden mb-4">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">
                            <input type="checkbox" id="seleccionar_todos"
                                onclick="document.querySelectorAll('.check_exp').forEach(c => c.checked = this.checked)">
                        </th>
                        <th class="px-4 py-3 text-left">Alumno</th>
                        <th class="px-4 py-3 text-left">Grado</th>
                        <th class="px-4 py-3 text-left">Ciclo Escolar</th>
                        <th class="px-4 py-3 text-left">Estado</th>
                        <th class="px-4 py-3 text-left">Ver</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($expedientes as $exp)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <input type="checkbox" name="seleccionados[]"
                                value="{{ $exp->id }}" class="check_exp">
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $exp->alumno->nombre_completo }}</td>
                        <td class="px-4 py-3">{{ $exp->alumno->escuela->grado ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $exp->alumno->ciclo_escolar }}</td>
                        <td class="px-4 py-3">
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pendiente</span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('alumnos.show', $exp->alumno) }}"
                               class="text-blue-600 hover:underline text-xs" target="_blank">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Observaciones y botones --}}
        <div class="bg-white rounded-xl shadow p-6">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>
                <textarea name="observaciones" rows="3"
                    placeholder="Escribe observaciones opcionales..."
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('observaciones') }}</textarea>
            </div>
            <div class="flex gap-3 justify-end">
                <button type="submit" formaction="{{ route('validacion.rechazar') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg text-sm font-semibold">
                    Rechazar selección
                </button>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-semibold">
                    ✓ Validar y Firmar selección
                </button>
            </div>
        </div>

    </form>
    @endif

</div>
@endsection