@extends('layouts.app')
@section('titulo', 'Nueva Cédula')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Nueva Cédula de Registro</h2>
        <a href="{{ route('alumnos.index') }}" class="text-sm text-gray-500 hover:underline">← Volver</a>
    </div>

    @if($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @php
    $estados = ['Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua',
        'Ciudad de México','Coahuila','Colima','Durango','Estado de México','Guanajuato','Guerrero',
        'Hidalgo','Jalisco','Michoacán','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro',
        'Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala',
        'Veracruz','Yucatán','Zacatecas'];
    $tiposSangre = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
    $nivelesEstudio = ['Sin estudios','Preescolar','Primaria','Secundaria','Preparatoria / Bachillerato',
        'Carrera técnica','Licenciatura','Maestría','Doctorado'];
    $lenguasMaternas = ['Español','Náhuatl','Maya','Zapoteco','Mixteco','Otomí','Totonaco',
        'Mazateco','Chol','Huasteco','Chinanteco','Mixe','Tzeltal','Tzotzil','Otro'];
    $grupos = ['A','B','C','D','E'];
    $gradosPorNivel = [
        'preescolar'   => ['1°','2°','3°'],
        'primaria'     => ['1°','2°','3°','4°','5°','6°'],
        'secundaria'   => ['1°','2°','3°'],
        'preparatoria' => ['1°','2°','3°'],
    ];
    $nivelActual = old('nivel', 'primaria');
    @endphp

    <form method="POST" action="{{ route('alumnos.store') }}">
    @csrf

    {{-- ENCABEZADO --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ciclo Escolar *</label>
                <input type="text" name="ciclo_escolar" value="{{ old('ciclo_escolar', '2025-2026') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha</label>
                <input type="date" name="fecha_cedula" value="{{ old('fecha_cedula', date('Y-m-d')) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    {{-- DATOS DEL ALUMNO --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos Generales del Alumno(a)</h3>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Paterno *</label>
                <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Materno *</label>
                <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre(s) *</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">
                    CURP *
                    <a href="https://www.gob.mx/curp/" target="_blank"
                       class="ml-1 text-blue-600 hover:text-blue-800 border border-blue-300 rounded px-1 text-xs font-normal">
                        🔗 Consultar CURP
                    </a>
                </label>
                <input type="text" name="curp" value="{{ old('curp') }}" maxlength="18"
                    class="w-full border rounded-lg px-3 py-2 text-sm uppercase focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha de Nacimiento *</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Género *</label>
                <select name="genero" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    <option value="H" {{ old('genero')=='H' ? 'selected' : '' }}>H — Hombre</option>
                    <option value="M" {{ old('genero')=='M' ? 'selected' : '' }}>M — Mujer</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">País de Nacimiento</label>
                <select name="pais_nacimiento" id="pais_nacimiento" onchange="toggleEstados()"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="México" {{ old('pais_nacimiento','México')=='México' ? 'selected' : '' }}>México</option>
                    <option value="Otro" {{ old('pais_nacimiento')=='Otro' ? 'selected' : '' }}>Otro país</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Entidad de Nacimiento *</label>
                <select name="entidad_nacimiento" id="entidad_nacimiento"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado }}" {{ old('entidad_nacimiento')==$estado ? 'selected' : '' }}>{{ $estado }}</option>
                    @endforeach
                </select>
                <input type="text" name="entidad_nacimiento_texto" id="entidad_nacimiento_texto"
                    placeholder="Escriba el país de nacimiento" value="{{ old('entidad_nacimiento_texto') }}"
                    class="hidden w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tipo de Sangre</label>
                <select name="tipo_sangre" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($tiposSangre as $tipo)
                        <option value="{{ $tipo }}" {{ old('tipo_sangre')==$tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Lengua Materna</label>
                <select name="lengua_materna" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($lenguasMaternas as $lengua)
                        <option value="{{ $lengua }}" {{ old('lengua_materna')==$lengua ? 'selected' : '' }}>{{ $lengua }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Discapacidad / Aptitud diferenciada</label>
                <input type="text" name="discapacidad" value="{{ old('discapacidad') }}" placeholder="Especificar o dejar vacío"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    {{-- DATOS DEL PADRE --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos del Padre</h3>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Paterno *</label>
                <input type="text" name="padre_apellido_paterno" value="{{ old('padre_apellido_paterno') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Materno</label>
                <input type="text" name="padre_apellido_materno" value="{{ old('padre_apellido_materno') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre(s) *</label>
                <input type="text" name="padre_nombre" value="{{ old('padre_nombre') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">
                    CURP
                    <a href="https://www.gob.mx/curp/" target="_blank"
                       class="ml-1 text-blue-600 hover:text-blue-800 border border-blue-300 rounded px-1 text-xs font-normal">
                        🔗 Consultar CURP
                    </a>
                </label>
                <input type="text" name="padre_curp" value="{{ old('padre_curp') }}" maxlength="18"
                    class="w-full border rounded-lg px-3 py-2 text-sm uppercase focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha de Nacimiento</label>
                <input type="date" name="padre_fecha_nacimiento" value="{{ old('padre_fecha_nacimiento') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nivel de Estudios</label>
                <select name="padre_nivel_estudios" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($nivelesEstudio as $nivel)
                        <option value="{{ $nivel }}" {{ old('padre_nivel_estudios')==$nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Celular</label>
                <input type="text" name="padre_tel_celular" value="{{ old('padre_tel_celular') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Fijo</label>
                <input type="text" name="padre_tel_fijo" value="{{ old('padre_tel_fijo') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Correo electrónico</label>
                <input type="email" name="padre_email" value="{{ old('padre_email') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ocupación</label>
                <input type="text" name="padre_ocupacion" value="{{ old('padre_ocupacion') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio</label>
                <input type="text" name="padre_municipio" value="{{ old('padre_municipio') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="padre_vive" {{ old('padre_vive') ? 'checked' : '' }}> Vive con el alumno</label>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="padre_es_tutor" {{ old('padre_es_tutor') ? 'checked' : '' }}> Es el tutor</label>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="padre_es_finado" {{ old('padre_es_finado') ? 'checked' : '' }}> Es finado</label>
        </div>
    </div>

    {{-- DATOS DE LA MADRE --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos de la Madre</h3>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Paterno *</label>
                <input type="text" name="madre_apellido_paterno" value="{{ old('madre_apellido_paterno') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Materno</label>
                <input type="text" name="madre_apellido_materno" value="{{ old('madre_apellido_materno') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre(s) *</label>
                <input type="text" name="madre_nombre" value="{{ old('madre_nombre') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">
                    CURP
                    <a href="https://www.gob.mx/curp/" target="_blank"
                       class="ml-1 text-blue-600 hover:text-blue-800 border border-blue-300 rounded px-1 text-xs font-normal">
                        🔗 Consultar CURP
                    </a>
                </label>
                <input type="text" name="madre_curp" value="{{ old('madre_curp') }}" maxlength="18"
                    class="w-full border rounded-lg px-3 py-2 text-sm uppercase focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha de Nacimiento</label>
                <input type="date" name="madre_fecha_nacimiento" value="{{ old('madre_fecha_nacimiento') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nivel de Estudios</label>
                <select name="madre_nivel_estudios" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($nivelesEstudio as $nivel)
                        <option value="{{ $nivel }}" {{ old('madre_nivel_estudios')==$nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Celular</label>
                <input type="text" name="madre_tel_celular" value="{{ old('madre_tel_celular') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Fijo</label>
                <input type="text" name="madre_tel_fijo" value="{{ old('madre_tel_fijo') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Correo electrónico</label>
                <input type="email" name="madre_email" value="{{ old('madre_email') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ocupación</label>
                <input type="text" name="madre_ocupacion" value="{{ old('madre_ocupacion') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio</label>
                <input type="text" name="madre_municipio" value="{{ old('madre_municipio') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="madre_vive" {{ old('madre_vive') ? 'checked' : '' }}> Vive con el alumno</label>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="madre_es_tutor" {{ old('madre_es_tutor') ? 'checked' : '' }}> Es la tutora</label>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="madre_es_finado" {{ old('madre_es_finado') ? 'checked' : '' }}> Es finada</label>
        </div>
    </div>

    {{-- TUTOR DIFERENTE --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <div class="flex items-center gap-3 mb-2">
            <input type="checkbox" name="tutor_diferente" id="tutor_diferente"
                {{ old('tutor_diferente') ? 'checked' : '' }} onchange="toggleTutor()">
            <label for="tutor_diferente" class="font-bold text-sm text-gray-700 uppercase cursor-pointer">
                El tutor es diferente al padre o madre
            </label>
        </div>
        <div id="seccion_tutor" class="{{ old('tutor_diferente') ? '' : 'hidden' }}">
            <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 mt-4 text-sm uppercase">Datos del Tutor</h3>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Paterno</label>
                    <input type="text" name="tutor_apellido_paterno" value="{{ old('tutor_apellido_paterno') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Materno</label>
                    <input type="text" name="tutor_apellido_materno" value="{{ old('tutor_apellido_materno') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Nombre(s)</label>
                    <input type="text" name="tutor_nombre" value="{{ old('tutor_nombre') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Parentesco</label>
                    <input type="text" name="tutor_parentesco" value="{{ old('tutor_parentesco') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">
                        CURP
                        <a href="https://www.gob.mx/curp/" target="_blank"
                           class="ml-1 text-blue-600 hover:text-blue-800 border border-blue-300 rounded px-1 text-xs font-normal">
                            🔗 Consultar CURP
                        </a>
                    </label>
                    <input type="text" name="tutor_curp" value="{{ old('tutor_curp') }}" maxlength="18"
                        class="w-full border rounded-lg px-3 py-2 text-sm uppercase focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Celular</label>
                    <input type="text" name="tutor_tel_celular" value="{{ old('tutor_tel_celular') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="tutor_vive" {{ old('tutor_vive') ? 'checked' : '' }}> Vive con el alumno</label>
                <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="tutor_legal" {{ old('tutor_legal') ? 'checked' : '' }}> Es tutor legal</label>
            </div>
        </div>
    </div>

    {{-- DOCUMENTO PROBATORIO (sección independiente) --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Documento Probatorio</h3>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Entidad Fed. de Registro <span class="text-gray-400">(1)</span></label>
                <select name="entidad_fed_registro" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado }}" {{ old('entidad_fed_registro')==$estado ? 'selected' : '' }}>{{ $estado }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio de Registro <span class="text-gray-400">(2)</span></label>
                <input type="text" name="municipio_registro" value="{{ old('municipio_registro') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Año de Registro <span class="text-gray-400">(3)</span></label>
                <select name="año_registro" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @for($y = date('Y'); $y >= 1990; $y--)
                        <option value="{{ $y }}" {{ old('año_registro')==$y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>

        {{-- Tipo de documento --}}
        <div class="grid grid-cols-4 gap-3 mb-4 border rounded-lg p-3 bg-gray-50 text-xs font-semibold">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="tipo_documento" value="acta_nacimiento"
                    {{ old('tipo_documento')=='acta_nacimiento' ? 'checked' : '' }}
                    onchange="cambiarDocumento('acta_nacimiento')">
                ACTA DE NACIMIENTO
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="tipo_documento" value="documento_migratorio"
                    {{ old('tipo_documento')=='documento_migratorio' ? 'checked' : '' }}
                    onchange="cambiarDocumento('documento_migratorio')">
                DOCUMENTO MIGRATORIO
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="tipo_documento" value="naturalizacion_sre"
                    {{ old('tipo_documento')=='naturalizacion_sre' ? 'checked' : '' }}
                    onchange="cambiarDocumento('naturalizacion_sre')">
                DOCUMENTO DE NATURALIZACIÓN DE LA SRE
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="tipo_documento" value="ficha_signaletica"
                    {{ old('tipo_documento')=='ficha_signaletica' ? 'checked' : '' }}
                    onchange="cambiarDocumento('ficha_signaletica')">
                FICHA SIGNALÉTICA
            </label>
        </div>

        {{-- Campos dinámicos según tipo --}}
        <div id="campos_acta" class="{{ old('tipo_documento')=='acta_nacimiento' ? '' : 'hidden' }} grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. de Libro <span class="text-gray-400">(4)</span></label>
                <input type="text" name="num_libro" value="{{ old('num_libro') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. de Acta</label>
                <input type="text" name="num_acta" value="{{ old('num_acta') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CRIP</label>
                <input type="text" name="crip" value="{{ old('crip') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div id="campos_migratorio" class="{{ old('tipo_documento')=='documento_migratorio' ? '' : 'hidden' }} grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. Registro Nacional de Extranjeros <span class="text-gray-400">(5)</span></label>
                <input type="text" name="num_registro_extranjeros" value="{{ old('num_registro_extranjeros') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div id="campos_naturalizacion" class="{{ old('tipo_documento')=='naturalizacion_sre' ? '' : 'hidden' }} grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Folio de la Carta <span class="text-gray-400">(6)</span></label>
                <input type="text" name="folio_carta" value="{{ old('folio_carta') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div id="campos_signaletica" class="{{ old('tipo_documento')=='ficha_signaletica' ? '' : 'hidden' }} grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. de Juzgado <span class="text-gray-400">(7)</span></label>
                <input type="text" name="num_juzgado" value="{{ old('num_juzgado') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Folio de la Ficha</label>
                <input type="text" name="folio_ficha" value="{{ old('folio_ficha') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- No entregó documento --}}
        <div class="mt-3">
            <label class="flex items-center gap-2 text-xs font-semibold cursor-pointer border rounded px-3 py-2 w-fit bg-gray-50">
                <input type="radio" name="tipo_documento" value="no_entrego"
                    {{ old('tipo_documento')=='no_entrego' ? 'checked' : '' }}
                    onchange="cambiarDocumento('no_entrego')">
                NO ENTREGÓ DOCUMENTO PROBATORIO <span class="text-gray-400 ml-1">(8)</span>
            </label>
        </div>

        <div class="mt-4">
            <label class="block text-xs font-medium text-gray-600 mb-1">Observaciones</label>
            <input type="text" name="doc_observaciones" value="{{ old('doc_observaciones') }}"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
    </div>

    {{-- DATOS DE LA ESCUELA --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos de la Escuela</h3>
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-600 mb-2">Nivel Educativo *</label>
            <div class="flex flex-wrap gap-5 text-sm">
                @foreach(['preescolar'=>'Preescolar / Kínder','primaria'=>'Primaria','secundaria'=>'Secundaria','preparatoria'=>'Preparatoria'] as $val => $etiqueta)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="nivel" value="{{ $val }}"
                        {{ $nivelActual == $val ? 'checked' : '' }}
                        onchange="actualizarGrados('{{ $val }}')">
                    {{ $etiqueta }}
                </label>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre de la Escuela *</label>
                <input type="text" name="nombre_escuela" value="{{ old('nombre_escuela', 'Prof. Nicolás Reyes Alegre') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CCT</label>
                <input type="text" name="cct" value="{{ old('cct') }}" placeholder="Ej. 21DPR0001A"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Turno</label>
                <select name="turno" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    <option value="matutino" {{ old('turno')=='matutino' ? 'selected' : '' }}>Matutino</option>
                    <option value="vespertino" {{ old('turno')=='vespertino' ? 'selected' : '' }}>Vespertino</option>
                    <option value="nocturno" {{ old('turno')=='nocturno' ? 'selected' : '' }}>Nocturno</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Grado *</label>
                <select name="grado" id="select_grado" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($gradosPorNivel[$nivelActual] as $grado)
                        <option value="{{ $grado }}" {{ old('grado')==$grado ? 'selected' : '' }}>{{ $grado }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Grupo</label>
                <select name="grupo" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo }}" {{ old('grupo')==$grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">ZE</label>
                <input type="text" name="ze" value="{{ old('ze') }}" placeholder="Zona Escolar"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    {{-- BOTONES --}}
    <div class="flex gap-3 justify-end mb-8">
        <a href="{{ route('alumnos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm">Cancelar</a>
        <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-6 py-2 rounded-lg text-sm font-semibold">Guardar Cédula</button>
    </div>

    </form>
</div>

<script>
const gradosPorNivel = {
    preescolar:   ['1°','2°','3°'],
    primaria:     ['1°','2°','3°','4°','5°','6°'],
    secundaria:   ['1°','2°','3°'],
    preparatoria: ['1°','2°','3°'],
};

function actualizarGrados(nivel) {
    const select = document.getElementById('select_grado');
    const anterior = select.value;
    select.innerHTML = '<option value="">Seleccionar</option>';
    gradosPorNivel[nivel].forEach(g => {
        const opt = document.createElement('option');
        opt.value = g; opt.textContent = g;
        if (g === anterior) opt.selected = true;
        select.appendChild(opt);
    });
}

function toggleTutor() {
    const cb = document.getElementById('tutor_diferente');
    document.getElementById('seccion_tutor').classList.toggle('hidden', !cb.checked);
}

function cambiarDocumento(tipo) {
    ['acta', 'migratorio', 'naturalizacion', 'signaletica'].forEach(t => {
        document.getElementById('campos_' + t)?.classList.add('hidden');
    });
    const mapa = {
        'acta_nacimiento':      'campos_acta',
        'documento_migratorio': 'campos_migratorio',
        'naturalizacion_sre':   'campos_naturalizacion',
        'ficha_signaletica':    'campos_signaletica',
    };
    if (mapa[tipo]) document.getElementById(mapa[tipo])?.classList.remove('hidden');
}

function toggleEstados() {
    const pais = document.getElementById('pais_nacimiento').value;
    const sel = document.getElementById('entidad_nacimiento');
    const txt = document.getElementById('entidad_nacimiento_texto');
    if (pais === 'México') {
        sel.classList.remove('hidden'); sel.name = 'entidad_nacimiento';
        txt.classList.add('hidden');    txt.name = '';
    } else {
        sel.classList.add('hidden');    sel.name = '';
        txt.classList.remove('hidden'); txt.name = 'entidad_nacimiento';
    }
}

// ── Validación fechas: padre/madre/tutor deben nacer ANTES que el alumno ──
function validarFechaPadre(campo, nombrePersona) {
    const fechaAlumnoInput = document.querySelector('input[name="fecha_nacimiento"]');
    if (!fechaAlumnoInput || !fechaAlumnoInput.value || !campo.value) {
        campo.setCustomValidity('');
        ocultarErrorFecha(campo);
        return;
    }
    const fechaAlumno = new Date(fechaAlumnoInput.value);
    const fechaPadre  = new Date(campo.value);

    if (fechaPadre >= fechaAlumno) {
        const msg = `La fecha de nacimiento del ${nombrePersona} debe ser anterior a la del alumno (${fechaAlumnoInput.value}).`;
        campo.setCustomValidity(msg);
        mostrarErrorFecha(campo, msg);
    } else {
        campo.setCustomValidity('');
        ocultarErrorFecha(campo);
    }
}

function mostrarErrorFecha(input, mensaje) {
    let err = input.parentElement.querySelector('.fecha-error');
    if (!err) {
        err = document.createElement('p');
        err.className = 'fecha-error text-red-600 text-xs mt-1';
        input.parentElement.appendChild(err);
    }
    err.textContent = mensaje;
    input.classList.add('border-red-500');
}

function ocultarErrorFecha(input) {
    const err = input.parentElement.querySelector('.fecha-error');
    if (err) err.remove();
    input.classList.remove('border-red-500');
}

document.addEventListener('DOMContentLoaded', function() {
    toggleEstados();
    const seleccionado = document.querySelector('input[name="tipo_documento"]:checked');
    if (seleccionado) cambiarDocumento(seleccionado.value);
    document.querySelectorAll('input[name$="curp"]').forEach(el => {
        el.addEventListener('input', function() { this.value = this.value.toUpperCase(); });
    });

    const camposFecha = [
        ['padre_fecha_nacimiento', 'padre'],
        ['madre_fecha_nacimiento', 'madre'],
        ['tutor_fecha_nacimiento', 'tutor'],
    ];
    const fechaAlumnoInput = document.querySelector('input[name="fecha_nacimiento"]');

    camposFecha.forEach(([name, label]) => {
        const campo = document.querySelector(`input[name="${name}"]`);
        if (!campo) return;
        // Validar cuando cambia la fecha del padre/madre/tutor
        campo.addEventListener('change', () => validarFechaPadre(campo, label));
        // Re-validar cuando cambia la fecha del alumno
        if (fechaAlumnoInput) {
            fechaAlumnoInput.addEventListener('change', () => validarFechaPadre(campo, label));
        }
    });

    // Bloquear submit si quedan errores
    document.querySelector('form').addEventListener('submit', function(e) {
        let hayError = false;
        camposFecha.forEach(([name, label]) => {
            const campo = document.querySelector(`input[name="${name}"]`);
            if (campo) {
                validarFechaPadre(campo, label);
                if (campo.validationMessage) hayError = true;
            }
        });
        if (hayError) e.preventDefault();
    });
});
</script>
@endsection