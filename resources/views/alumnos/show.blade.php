@extends('layouts.app')
@section('titulo', 'Detalle del Alumno')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Expediente: {{ $alumno->nombre_completo }}</h2>
        <div class="flex gap-2">
            <a href="{{ route('alumnos.edit', $alumno) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">
                Editar
            </a>
            <a href="{{ route('alumnos.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">
                ← Volver
            </a>
        </div>
    </div>

    {{-- Estado del expediente --}}
    <div class="bg-white rounded-xl shadow p-4 mb-4 flex items-center gap-4">
        @if($alumno->expediente?->validado)
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">✓ Expediente Validado</span>
            <span class="text-gray-500 text-sm">Por: {{ $alumno->expediente->validador?->name }} — {{ $alumno->expediente->fecha_validacion }}</span>
        @else
            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">⏳ Pendiente de validación</span>
        @endif
    </div>

    {{-- NIA destacado --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4 flex items-center gap-3">
        <span class="text-gray-500 text-sm">NIA del alumno:</span>
        <span class="font-mono font-bold text-blue-900 text-xl">{{ $alumno->nia }}</span>
    </div>

    {{-- Datos del alumno --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos Generales del Alumno
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Ciclo Escolar:</span><p class="font-medium">{{ $alumno->ciclo_escolar }}</p></div>
            <div><span class="text-gray-500">Fecha Cédula:</span><p class="font-medium">{{ $alumno->fecha_cedula }}</p></div>
            <div><span class="text-gray-500">Apellido Paterno:</span><p class="font-medium">{{ $alumno->apellido_paterno }}</p></div>
            <div><span class="text-gray-500">Apellido Materno:</span><p class="font-medium">{{ $alumno->apellido_materno }}</p></div>
            <div><span class="text-gray-500">Nombre(s):</span><p class="font-medium">{{ $alumno->nombre }}</p></div>
            <div><span class="text-gray-500">CURP:</span><p class="font-mono font-medium">{{ $alumno->curp }}</p></div>
            <div><span class="text-gray-500">Fecha de Nacimiento:</span><p class="font-medium">{{ $alumno->fecha_nacimiento }}</p></div>
            <div><span class="text-gray-500">Género:</span><p class="font-medium">{{ $alumno->genero == 'H' ? 'Hombre' : 'Mujer' }}</p></div>
            <div><span class="text-gray-500">País de Nacimiento:</span><p class="font-medium">{{ $alumno->pais_nacimiento }}</p></div>
            <div><span class="text-gray-500">Entidad de Nacimiento:</span><p class="font-medium">{{ $alumno->entidad_nacimiento }}</p></div>
            <div><span class="text-gray-500">Tipo de Sangre:</span><p class="font-medium">{{ $alumno->tipo_sangre ?? '—' }}</p></div>
            <div><span class="text-gray-500">Lengua Materna:</span><p class="font-medium">{{ $alumno->lengua_materna ?? '—' }}</p></div>
            <div><span class="text-gray-500">Discapacidad:</span><p class="font-medium">{{ $alumno->discapacidad ?? '—' }}</p></div>
        </div>
    </div>

    {{-- Datos del padre --}}
    @if($alumno->padre)
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos del Padre
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Nombre completo:</span><p class="font-medium">{{ $alumno->padre->apellido_paterno }} {{ $alumno->padre->apellido_materno }} {{ $alumno->padre->nombre }}</p></div>
            <div><span class="text-gray-500">CURP:</span><p class="font-mono font-medium">{{ $alumno->padre->curp ?? '—' }}</p></div>
            <div><span class="text-gray-500">Tel. Celular:</span><p class="font-medium">{{ $alumno->padre->tel_celular ?? '—' }}</p></div>
            <div><span class="text-gray-500">Correo:</span><p class="font-medium">{{ $alumno->padre->email ?? '—' }}</p></div>
            <div><span class="text-gray-500">Ocupación:</span><p class="font-medium">{{ $alumno->padre->ocupacion ?? '—' }}</p></div>
            <div>
                <span class="text-gray-500">Estado:</span>
                <p class="font-medium">
                    {{ $alumno->padre->vive_con_alumno ? 'Vive con el alumno' : 'No vive con el alumno' }}
                    {{ $alumno->padre->es_finado ? '· Finado' : '' }}
                    {{ $alumno->padre->es_tutor ? '· Es tutor' : '' }}
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- Datos de la madre --}}
    @if($alumno->madre)
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos de la Madre
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Nombre completo:</span><p class="font-medium">{{ $alumno->madre->apellido_paterno }} {{ $alumno->madre->apellido_materno }} {{ $alumno->madre->nombre }}</p></div>
            <div><span class="text-gray-500">CURP:</span><p class="font-mono font-medium">{{ $alumno->madre->curp ?? '—' }}</p></div>
            <div><span class="text-gray-500">Tel. Celular:</span><p class="font-medium">{{ $alumno->madre->tel_celular ?? '—' }}</p></div>
            <div><span class="text-gray-500">Correo:</span><p class="font-medium">{{ $alumno->madre->email ?? '—' }}</p></div>
            <div><span class="text-gray-500">Ocupación:</span><p class="font-medium">{{ $alumno->madre->ocupacion ?? '—' }}</p></div>
            <div>
                <span class="text-gray-500">Estado:</span>
                <p class="font-medium">
                    {{ $alumno->madre->vive_con_alumno ? 'Vive con el alumno' : 'No vive con el alumno' }}
                    {{ $alumno->madre->es_finado ? '· Finada' : '' }}
                    {{ $alumno->madre->es_tutor ? '· Es tutora' : '' }}
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- Datos del tutor --}}
    @if($alumno->tutor)
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos del Tutor
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Nombre completo:</span><p class="font-medium">{{ $alumno->tutor->apellido_paterno }} {{ $alumno->tutor->apellido_materno }} {{ $alumno->tutor->nombre }}</p></div>
            <div><span class="text-gray-500">Parentesco:</span><p class="font-medium">{{ $alumno->tutor->parentesco ?? '—' }}</p></div>
            <div><span class="text-gray-500">Tel. Celular:</span><p class="font-medium">{{ $alumno->tutor->tel_celular ?? '—' }}</p></div>
        </div>
    </div>
    @endif

    {{-- Datos escuela --}}
    @if($alumno->escuela)
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos de la Escuela
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Escuela:</span><p class="font-medium">{{ $alumno->escuela->nombre_escuela }}</p></div>
            <div><span class="text-gray-500">CCT:</span><p class="font-medium">{{ $alumno->escuela->cct ?? '—' }}</p></div>
            <div><span class="text-gray-500">Turno:</span><p class="font-medium capitalize">{{ $alumno->escuela->turno ?? '—' }}</p></div>
            <div><span class="text-gray-500">Grado:</span><p class="font-medium">{{ $alumno->escuela->grado }}</p></div>
            <div><span class="text-gray-500">Grupo:</span><p class="font-medium">{{ $alumno->escuela->grupo ?? '—' }}</p></div>
            <div><span class="text-gray-500">ZE:</span><p class="font-medium">{{ $alumno->escuela->ze ?? '—' }}</p></div>
        </div>
    </div>
    @endif

</div>
@endsection@extends('layouts.app')
@section('titulo', 'Detalle del Alumno')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Expediente: {{ $alumno->nombre_completo }}</h2>
        <div class="flex gap-2">
            <a href="{{ route('alumnos.edit', $alumno) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">
                Editar
            </a>
            <a href="{{ route('alumnos.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">
                ← Volver
            </a>
        </div>
    </div>

    {{-- Estado del expediente --}}
    <div class="bg-white rounded-xl shadow p-4 mb-4 flex items-center gap-4">
        @if($alumno->expediente?->validado)
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">✓ Expediente Validado</span>
            <span class="text-gray-500 text-sm">Por: {{ $alumno->expediente->validador?->name }} — {{ $alumno->expediente->fecha_validacion }}</span>
        @else
            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">⏳ Pendiente de validación</span>
        @endif
    </div>

    {{-- NIA destacado --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4 flex items-center gap-3">
        <span class="text-gray-500 text-sm">NIA del alumno:</span>
        <span class="font-mono font-bold text-blue-900 text-xl">{{ $alumno->nia }}</span>
    </div>

    {{-- Datos del alumno --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos Generales del Alumno
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Ciclo Escolar:</span><p class="font-medium">{{ $alumno->ciclo_escolar }}</p></div>
            <div><span class="text-gray-500">Fecha Cédula:</span><p class="font-medium">{{ $alumno->fecha_cedula }}</p></div>
            <div><span class="text-gray-500">Apellido Paterno:</span><p class="font-medium">{{ $alumno->apellido_paterno }}</p></div>
            <div><span class="text-gray-500">Apellido Materno:</span><p class="font-medium">{{ $alumno->apellido_materno }}</p></div>
            <div><span class="text-gray-500">Nombre(s):</span><p class="font-medium">{{ $alumno->nombre }}</p></div>
            <div><span class="text-gray-500">CURP:</span><p class="font-mono font-medium">{{ $alumno->curp }}</p></div>
            <div><span class="text-gray-500">Fecha de Nacimiento:</span><p class="font-medium">{{ $alumno->fecha_nacimiento }}</p></div>
            <div><span class="text-gray-500">Género:</span><p class="font-medium">{{ $alumno->genero == 'H' ? 'Hombre' : 'Mujer' }}</p></div>
            <div><span class="text-gray-500">País de Nacimiento:</span><p class="font-medium">{{ $alumno->pais_nacimiento }}</p></div>
            <div><span class="text-gray-500">Entidad de Nacimiento:</span><p class="font-medium">{{ $alumno->entidad_nacimiento }}</p></div>
            <div><span class="text-gray-500">Tipo de Sangre:</span><p class="font-medium">{{ $alumno->tipo_sangre ?? '—' }}</p></div>
            <div><span class="text-gray-500">Lengua Materna:</span><p class="font-medium">{{ $alumno->lengua_materna ?? '—' }}</p></div>
            <div><span class="text-gray-500">Discapacidad:</span><p class="font-medium">{{ $alumno->discapacidad ?? '—' }}</p></div>
        </div>
    </div>

    {{-- Datos del padre --}}
    @if($alumno->padre)
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos del Padre
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Nombre completo:</span><p class="font-medium">{{ $alumno->padre->apellido_paterno }} {{ $alumno->padre->apellido_materno }} {{ $alumno->padre->nombre }}</p></div>
            <div><span class="text-gray-500">CURP:</span><p class="font-mono font-medium">{{ $alumno->padre->curp ?? '—' }}</p></div>
            <div><span class="text-gray-500">Tel. Celular:</span><p class="font-medium">{{ $alumno->padre->tel_celular ?? '—' }}</p></div>
            <div><span class="text-gray-500">Correo:</span><p class="font-medium">{{ $alumno->padre->email ?? '—' }}</p></div>
            <div><span class="text-gray-500">Ocupación:</span><p class="font-medium">{{ $alumno->padre->ocupacion ?? '—' }}</p></div>
            <div>
                <span class="text-gray-500">Estado:</span>
                <p class="font-medium">
                    {{ $alumno->padre->vive_con_alumno ? 'Vive con el alumno' : 'No vive con el alumno' }}
                    {{ $alumno->padre->es_finado ? '· Finado' : '' }}
                    {{ $alumno->padre->es_tutor ? '· Es tutor' : '' }}
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- Datos de la madre --}}
    @if($alumno->madre)
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos de la Madre
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Nombre completo:</span><p class="font-medium">{{ $alumno->madre->apellido_paterno }} {{ $alumno->madre->apellido_materno }} {{ $alumno->madre->nombre }}</p></div>
            <div><span class="text-gray-500">CURP:</span><p class="font-mono font-medium">{{ $alumno->madre->curp ?? '—' }}</p></div>
            <div><span class="text-gray-500">Tel. Celular:</span><p class="font-medium">{{ $alumno->madre->tel_celular ?? '—' }}</p></div>
            <div><span class="text-gray-500">Correo:</span><p class="font-medium">{{ $alumno->madre->email ?? '—' }}</p></div>
            <div><span class="text-gray-500">Ocupación:</span><p class="font-medium">{{ $alumno->madre->ocupacion ?? '—' }}</p></div>
            <div>
                <span class="text-gray-500">Estado:</span>
                <p class="font-medium">
                    {{ $alumno->madre->vive_con_alumno ? 'Vive con el alumno' : 'No vive con el alumno' }}
                    {{ $alumno->madre->es_finado ? '· Finada' : '' }}
                    {{ $alumno->madre->es_tutor ? '· Es tutora' : '' }}
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- Datos del tutor --}}
    @if($alumno->tutor)
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos del Tutor
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Nombre completo:</span><p class="font-medium">{{ $alumno->tutor->apellido_paterno }} {{ $alumno->tutor->apellido_materno }} {{ $alumno->tutor->nombre }}</p></div>
            <div><span class="text-gray-500">Parentesco:</span><p class="font-medium">{{ $alumno->tutor->parentesco ?? '—' }}</p></div>
            <div><span class="text-gray-500">Tel. Celular:</span><p class="font-medium">{{ $alumno->tutor->tel_celular ?? '—' }}</p></div>
        </div>
    </div>
    @endif

    {{-- Datos escuela --}}
    @if($alumno->escuela)
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos de la Escuela
        </h3>
        <div class="grid grid-cols-3 gap-4 text-sm">
            <div><span class="text-gray-500">Escuela:</span><p class="font-medium">{{ $alumno->escuela->nombre_escuela }}</p></div>
            <div><span class="text-gray-500">CCT:</span><p class="font-medium">{{ $alumno->escuela->cct ?? '—' }}</p></div>
            <div><span class="text-gray-500">Turno:</span><p class="font-medium capitalize">{{ $alumno->escuela->turno ?? '—' }}</p></div>
            <div><span class="text-gray-500">Grado:</span><p class="font-medium">{{ $alumno->escuela->grado }}</p></div>
            <div><span class="text-gray-500">Grupo:</span><p class="font-medium">{{ $alumno->escuela->grupo ?? '—' }}</p></div>
            <div><span class="text-gray-500">ZE:</span><p class="font-medium">{{ $alumno->escuela->ze ?? '—' }}</p></div>
        </div>
    </div>
    @endif

</div>
@endsection