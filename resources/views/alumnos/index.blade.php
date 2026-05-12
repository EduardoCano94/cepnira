@extends('layouts.app')
@section('titulo', 'Alumnos')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Alumnos</h2>
    <a href="{{ route('alumnos.create') }}"
       class="bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm">
        + Nueva cédula
    </a>
</div>

{{-- Buscador --}}
<form method="GET" action="{{ route('alumnos.index') }}" class="mb-4">
    <div class="flex gap-2">
        <input type="text" name="buscar" value="{{ request('buscar') }}"
            placeholder="Buscar por nombre o CURP..."
            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
            class="bg-blue-900 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800">
            Buscar
        </button>
        @if(request('buscar'))
        <a href="{{ route('alumnos.index') }}"
           class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-300">
            Limpiar
        </a>
        @endif
    </div>
</form>

{{-- Tabla --}}
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th class="px-4 py-3 text-left">Nombre completo</th>
                <th class="px-4 py-3 text-left">CURP</th>
                <th class="px-4 py-3 text-left">Grado</th>
                <th class="px-4 py-3 text-left">Ciclo escolar</th>
                <th class="px-4 py-3 text-left">Estado</th>
                <th class="px-4 py-3 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($alumnos as $alumno)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium">{{ $alumno->nombre_completo }}</td>
                <td class="px-4 py-3 font-mono text-xs">{{ $alumno->curp }}</td>
                <td class="px-4 py-3">{{ $alumno->escuela->grado ?? '—' }}</td>
                <td class="px-4 py-3">{{ $alumno->ciclo_escolar }}</td>
                <td class="px-4 py-3">
                    @if($alumno->expediente?->validado)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Validado</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pendiente</span>
                    @endif
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('alumnos.show', $alumno) }}"
                       class="text-blue-600 hover:underline text-xs">Ver</a>
                    <a href="{{ route('alumnos.edit', $alumno) }}"
                       class="text-yellow-600 hover:underline text-xs">Editar</a>
                    <form method="POST" action="{{ route('alumnos.destroy', $alumno) }}"
                          onsubmit="return confirm('¿Eliminar este alumno?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline text-xs">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                    No hay alumnos registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4">
        {{ $alumnos->withQueryString()->links() }}
    </div>
</div>
@endsection