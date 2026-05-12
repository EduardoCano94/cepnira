@extends('layouts.app')
@section('titulo', 'Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
    <p class="text-gray-500 text-sm">Bienvenido, {{ auth()->user()->name }} —
        <span class="capitalize">{{ auth()->user()->rol }}</span>
    </p>
</div>

{{-- Tarjetas resumen --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-600">
        <p class="text-gray-500 text-xs uppercase tracking-wide">Total alumnos</p>
        <p class="text-4xl font-bold text-blue-900 mt-1">{{ $totalAlumnos }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500">
        <p class="text-gray-500 text-xs uppercase tracking-wide">Validados</p>
        <p class="text-4xl font-bold text-green-600 mt-1">{{ $validados }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-400">
        <p class="text-gray-500 text-xs uppercase tracking-wide">Pendientes</p>
        <p class="text-4xl font-bold text-yellow-500 mt-1">{{ $pendientes }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-5 border-l-4 border-purple-500">
        <p class="text-gray-500 text-xs uppercase tracking-wide">Ciclos registrados</p>
        <p class="text-4xl font-bold text-purple-700 mt-1">{{ $porCiclo->count() }}</p>
    </div>
</div>

{{-- Estadísticas --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

    {{-- Género --}}
    <div class="bg-white rounded-xl shadow p-5">
        <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Por Género</h3>
        @php $totalGen = $hombres + $mujeres; @endphp

        <div class="mb-3">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-blue-700 font-medium">Hombres</span>
                <span class="font-bold">{{ $hombres }}</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full"
                    style="width: {{ $totalGen > 0 ? round($hombres/$totalGen*100) : 0 }}%"></div>
            </div>
            <p class="text-xs text-gray-400 mt-1">{{ $totalGen > 0 ? round($hombres/$totalGen*100) : 0 }}%</p>
        </div>

        <div>
            <div class="flex justify-between text-sm mb-1">
                <span class="text-pink-600 font-medium">Mujeres</span>
                <span class="font-bold">{{ $mujeres }}</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-3">
                <div class="bg-pink-500 h-3 rounded-full"
                    style="width: {{ $totalGen > 0 ? round($mujeres/$totalGen*100) : 0 }}%"></div>
            </div>
            <p class="text-xs text-gray-400 mt-1">{{ $totalGen > 0 ? round($mujeres/$totalGen*100) : 0 }}%</p>
        </div>
    </div>

    {{-- Por turno --}}
    <div class="bg-white rounded-xl shadow p-5">
        <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Por Turno</h3>
        @php
            $coloresTurno = ['matutino' => 'bg-orange-400', 'vespertino' => 'bg-indigo-500', 'nocturno' => 'bg-gray-700'];
            $totalTurno = $porTurno->sum();
        @endphp
        @forelse($porTurno as $turno => $cantidad)
        <div class="mb-3">
            <div class="flex justify-between text-sm mb-1">
                <span class="font-medium capitalize">{{ $turno ?? 'Sin turno' }}</span>
                <span class="font-bold">{{ $cantidad }}</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-3">
                <div class="{{ $coloresTurno[$turno] ?? 'bg-gray-400' }} h-3 rounded-full"
                    style="width: {{ $totalTurno > 0 ? round($cantidad/$totalTurno*100) : 0 }}%"></div>
            </div>
        </div>
        @empty
        <p class="text-gray-400 text-sm">Sin datos aún.</p>
        @endforelse
    </div>

    {{-- Por ciclo escolar --}}
    <div class="bg-white rounded-xl shadow p-5">
        <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Por Ciclo Escolar</h3>
        @forelse($porCiclo as $ciclo => $cantidad)
        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
            <span class="text-sm font-medium text-gray-700">{{ $ciclo }}</span>
            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full">{{ $cantidad }}</span>
        </div>
        @empty
        <p class="text-gray-400 text-sm">Sin datos aún.</p>
        @endforelse
    </div>

</div>

{{-- Por grado --}}
<div class="bg-white rounded-xl shadow p-5 mb-6">
    <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Alumnos por Grado</h3>
    @php $maxGrado = $porGrado->max() ?: 1; @endphp
    @forelse($porGrado as $grado => $cantidad)
    <div class="flex items-center gap-3 mb-2">
        <span class="text-sm text-gray-600 w-24 text-right">Grado {{ $grado }}</span>
        <div class="flex-1 bg-gray-100 rounded-full h-5">
            <div class="bg-blue-700 h-5 rounded-full flex items-center justify-end pr-2"
                style="width: {{ round($cantidad/$maxGrado*100) }}%">
                <span class="text-white text-xs font-bold">{{ $cantidad }}</span>
            </div>
        </div>
    </div>
    @empty
    <p class="text-gray-400 text-sm">Sin datos aún.</p>
    @endforelse
</div>

{{-- Registros recientes --}}
<div class="bg-white rounded-xl shadow">
    <div class="p-4 border-b flex justify-between items-center">
        <h3 class="font-semibold text-gray-700">Registros recientes</h3>
        <a href="{{ route('alumnos.index') }}" class="text-blue-600 text-sm hover:underline">Ver todos →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">NIA</th>
                    <th class="px-4 py-3 text-left">Alumno</th>
                    <th class="px-4 py-3 text-left">Grado</th>
                    <th class="px-4 py-3 text-left">Ciclo</th>
                    <th class="px-4 py-3 text-left">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recientes as $exp)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs text-blue-800">{{ $exp->alumno->nia }}</td>
                    <td class="px-4 py-3 font-medium">
                        <a href="{{ route('alumnos.show', $exp->alumno) }}"
                           class="hover:text-blue-600">
                            {{ $exp->alumno->nombre_completo }}
                        </a>
                    </td>
                    <td class="px-4 py-3">{{ $exp->alumno->escuela->grado ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $exp->alumno->ciclo_escolar }}</td>
                    <td class="px-4 py-3">
                        @if($exp->validado)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Validado</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pendiente</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                        No hay registros aún.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection