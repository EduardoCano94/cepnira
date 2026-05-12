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

    $grados = ['1°','2°','3°','4°','5°','6°'];
    $grupos = ['A','B','C','D','E'];
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
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos Generales del Alumno
        </h3>
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
                <label class="block text-xs font-medium text-gray-600 mb-1">CURP *</label>
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
                <select name="genero"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
                        <option value="{{ $estado }}" {{ old('entidad_nacimiento')==$estado ? 'selected' : '' }}>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="entidad_nacimiento_texto" id="entidad_nacimiento_texto"
                    placeholder="Escriba el país de nacimiento"
                    value="{{ old('entidad_nacimiento_texto') }}"
                    class="hidden w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tipo de Sangre</label>
                <select name="tipo_sangre"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
                <select name="lengua_materna"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($lenguasMaternas as $lengua)
                        <option value="{{ $lengua }}" {{ old('lengua_materna')==$lengua ? 'selected' : '' }}>{{ $lengua }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Discapacidad / Aptitud diferenciada</label>
                <input type="text" name="discapacidad" value="{{ old('discapacidad') }}"
                    placeholder="Especificar o dejar vacío"
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
                <label class="block text-xs font-medium text-gray-600 mb-1">CURP</label>
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
                <select name="padre_nivel_estudios"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="padre_vive" {{ old('padre_vive') ? 'checked' : '' }}> Vive con el alumno
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="padre_es_tutor" {{ old('padre_es_tutor') ? 'checked' : '' }}> Es el tutor
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="padre_es_finado" {{ old('padre_es_finado') ? 'checked' : '' }}> Es finado
            </label>
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
                <label class="block text-xs font-medium text-gray-600 mb-1">CURP</label>
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
                <select name="madre_nivel_estudios"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="madre_vive" {{ old('madre_vive') ? 'checked' : '' }}> Vive con el alumno
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="madre_es_tutor" {{ old('madre_es_tutor') ? 'checked' : '' }}> Es la tutora
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="madre_es_finado" {{ old('madre_es_finado') ? 'checked' : '' }}> Es finada
            </label>
        </div>
    </div>

    {{-- TUTOR DIFERENTE --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <div class="flex items-center gap-3 mb-4">
            <input type="checkbox" name="tutor_diferente" id="tutor_diferente"
                {{ old('tutor_diferente') ? 'checked' : '' }}
                onchange="document.getElementById('seccion_tutor').classList.toggle('hidden')">
            <label for="tutor_diferente" class="font-bold text-sm text-gray-700 uppercase">
                El tutor es diferente al padre o madre
            </label>
        </div>
        <div id="seccion_tutor" class="{{ old('tutor_diferente') ? '' : 'hidden' }}">
            <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos del Tutor</h3>
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
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Parentesco</label>
                    <input type="text" name="tutor_parentesco" value="{{ old('tutor_parentesco') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Celular</label>
                    <input type="text" name="tutor_tel_celular" value="{{ old('tutor_tel_celular') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="tutor_legal"> Es tutor legal
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- DOCUMENTO PROBATORIO --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Documento Probatorio</h3>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Entidad Fed. de Registro</label>
                <select name="entidad_fed_registro"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado }}" {{ old('entidad_fed_registro')==$estado ? 'selected' : '' }}>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio de Registro</label>
                <input type="text" name="municipio_registro" value="{{ old('municipio_registro') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Año de Registro</label>
                <select name="año_registro"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @for($y = date('Y'); $y >= 1990; $y--)
                        <option value="{{ $y }}" {{ old('año_registro')==$y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-600 mb-2">Tipo de Documento</label>
            <div class="flex flex-wrap gap-4 text-sm">
                @foreach(['acta_nacimiento'=>'Acta de Nacimiento','documento_migratorio'=>'Documento Migratorio','naturalizacion_sre'=>'Naturalización SRE','ficha_sinalética'=>'Ficha Signalética','no_entrego'=>'No entregó documento'] as $val => $label)
                <label class="flex items-center gap-2">
                    <input type="radio" name="tipo_documento" value="{{ $val }}"
                        {{ old('tipo_documento')==$val ? 'checked' : '' }}> {{ $label }}
                </label>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. de Libro</label>
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
    </div>

    {{-- DATOS DE LA ESCUELA --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos de la Escuela</h3>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre de la Escuela *</label>
                <input type="text" name="nombre_escuela" value="{{ old('nombre_escuela', 'Prof. Nicolás Reyes Alegre') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CCT</label>
                <input type="text" name="cct" value="{{ old('cct') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Turno</label>
                <select name="turno"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    <option value="matutino" {{ old('turno')=='matutino' ? 'selected' : '' }}>Matutino</option>
                    <option value="vespertino" {{ old('turno')=='vespertino' ? 'selected' : '' }}>Vespertino</option>
                    <option value="nocturno" {{ old('turno')=='nocturno' ? 'selected' : '' }}>Nocturno</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Grado *</label>
                <select name="grado"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($grados as $grado)
                        <option value="{{ $grado }}" {{ old('grado')==$grado ? 'selected' : '' }}>{{ $grado }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Grupo</label>
                <select name="grupo"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo }}" {{ old('grupo')==$grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">ZE</label>
                <input type="text" name="ze" value="{{ old('ze') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    {{-- BOTONES --}}
    <div class="flex gap-3 justify-end mb-8">
        <a href="{{ route('alumnos.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm">
            Cancelar
        </a>
        <button type="submit"
            class="bg-blue-900 hover:bg-blue-800 text-white px-6 py-2 rounded-lg text-sm font-semibold">
            Guardar Cédula
        </button>
    </div>

    </form>
</div>

{{-- JS para mostrar/ocultar estados según país --}}
<script>
function toggleEstados() {
    const pais = document.getElementById('pais_nacimiento').value;
    const selectEstado = document.getElementById('entidad_nacimiento');
    const inputTexto = document.getElementById('entidad_nacimiento_texto');

    if (pais === 'México') {
        selectEstado.classList.remove('hidden');
        selectEstado.name = 'entidad_nacimiento';
        inputTexto.classList.add('hidden');
        inputTexto.name = '';
    } else {
        selectEstado.classList.add('hidden');
        selectEstado.name = '';
        inputTexto.classList.remove('hidden');
        inputTexto.name = 'entidad_nacimiento';
    }
}

// Ejecutar al cargar por si viene con old()
document.addEventListener('DOMContentLoaded', toggleEstados);
</script>

@endsection@extends('layouts.app')
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

    $grados = ['1°','2°','3°','4°','5°','6°'];
    $grupos = ['A','B','C','D','E'];
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
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">
            Datos Generales del Alumno
        </h3>
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
                <label class="block text-xs font-medium text-gray-600 mb-1">CURP *</label>
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
                <select name="genero"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
                        <option value="{{ $estado }}" {{ old('entidad_nacimiento')==$estado ? 'selected' : '' }}>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="entidad_nacimiento_texto" id="entidad_nacimiento_texto"
                    placeholder="Escriba el país de nacimiento"
                    value="{{ old('entidad_nacimiento_texto') }}"
                    class="hidden w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tipo de Sangre</label>
                <select name="tipo_sangre"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
                <select name="lengua_materna"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($lenguasMaternas as $lengua)
                        <option value="{{ $lengua }}" {{ old('lengua_materna')==$lengua ? 'selected' : '' }}>{{ $lengua }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Discapacidad / Aptitud diferenciada</label>
                <input type="text" name="discapacidad" value="{{ old('discapacidad') }}"
                    placeholder="Especificar o dejar vacío"
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
                <label class="block text-xs font-medium text-gray-600 mb-1">CURP</label>
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
                <select name="padre_nivel_estudios"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="padre_vive" {{ old('padre_vive') ? 'checked' : '' }}> Vive con el alumno
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="padre_es_tutor" {{ old('padre_es_tutor') ? 'checked' : '' }}> Es el tutor
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="padre_es_finado" {{ old('padre_es_finado') ? 'checked' : '' }}> Es finado
            </label>
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
                <label class="block text-xs font-medium text-gray-600 mb-1">CURP</label>
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
                <select name="madre_nivel_estudios"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
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
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="madre_vive" {{ old('madre_vive') ? 'checked' : '' }}> Vive con el alumno
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="madre_es_tutor" {{ old('madre_es_tutor') ? 'checked' : '' }}> Es la tutora
            </label>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="madre_es_finado" {{ old('madre_es_finado') ? 'checked' : '' }}> Es finada
            </label>
        </div>
    </div>

    {{-- TUTOR DIFERENTE --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <div class="flex items-center gap-3 mb-4">
            <input type="checkbox" name="tutor_diferente" id="tutor_diferente"
                {{ old('tutor_diferente') ? 'checked' : '' }}
                onchange="document.getElementById('seccion_tutor').classList.toggle('hidden')">
            <label for="tutor_diferente" class="font-bold text-sm text-gray-700 uppercase">
                El tutor es diferente al padre o madre
            </label>
        </div>
        <div id="seccion_tutor" class="{{ old('tutor_diferente') ? '' : 'hidden' }}">
            <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos del Tutor</h3>
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
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Parentesco</label>
                    <input type="text" name="tutor_parentesco" value="{{ old('tutor_parentesco') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Celular</label>
                    <input type="text" name="tutor_tel_celular" value="{{ old('tutor_tel_celular') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="flex items-end pb-2">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="tutor_legal"> Es tutor legal
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- DOCUMENTO PROBATORIO --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Documento Probatorio</h3>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Entidad Fed. de Registro</label>
                <select name="entidad_fed_registro"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado }}" {{ old('entidad_fed_registro')==$estado ? 'selected' : '' }}>
                            {{ $estado }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio de Registro</label>
                <input type="text" name="municipio_registro" value="{{ old('municipio_registro') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Año de Registro</label>
                <select name="año_registro"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @for($y = date('Y'); $y >= 1990; $y--)
                        <option value="{{ $y }}" {{ old('año_registro')==$y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-xs font-medium text-gray-600 mb-2">Tipo de Documento</label>
            <div class="flex flex-wrap gap-4 text-sm">
                @foreach(['acta_nacimiento'=>'Acta de Nacimiento','documento_migratorio'=>'Documento Migratorio','naturalizacion_sre'=>'Naturalización SRE','ficha_sinalética'=>'Ficha Signalética','no_entrego'=>'No entregó documento'] as $val => $label)
                <label class="flex items-center gap-2">
                    <input type="radio" name="tipo_documento" value="{{ $val }}"
                        {{ old('tipo_documento')==$val ? 'checked' : '' }}> {{ $label }}
                </label>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. de Libro</label>
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
    </div>

    {{-- DATOS DE LA ESCUELA --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos de la Escuela</h3>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre de la Escuela *</label>
                <input type="text" name="nombre_escuela" value="{{ old('nombre_escuela', 'Prof. Nicolás Reyes Alegre') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CCT</label>
                <input type="text" name="cct" value="{{ old('cct') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Turno</label>
                <select name="turno"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    <option value="matutino" {{ old('turno')=='matutino' ? 'selected' : '' }}>Matutino</option>
                    <option value="vespertino" {{ old('turno')=='vespertino' ? 'selected' : '' }}>Vespertino</option>
                    <option value="nocturno" {{ old('turno')=='nocturno' ? 'selected' : '' }}>Nocturno</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Grado *</label>
                <select name="grado"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($grados as $grado)
                        <option value="{{ $grado }}" {{ old('grado')==$grado ? 'selected' : '' }}>{{ $grado }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Grupo</label>
                <select name="grupo"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo }}" {{ old('grupo')==$grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">ZE</label>
                <input type="text" name="ze" value="{{ old('ze') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    {{-- BOTONES --}}
    <div class="flex gap-3 justify-end mb-8">
        <a href="{{ route('alumnos.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm">
            Cancelar
        </a>
        <button type="submit"
            class="bg-blue-900 hover:bg-blue-800 text-white px-6 py-2 rounded-lg text-sm font-semibold">
            Guardar Cédula
        </button>
    </div>

    </form>
</div>

{{-- JS para mostrar/ocultar estados según país --}}
<script>
function toggleEstados() {
    const pais = document.getElementById('pais_nacimiento').value;
    const selectEstado = document.getElementById('entidad_nacimiento');
    const inputTexto = document.getElementById('entidad_nacimiento_texto');

    if (pais === 'México') {
        selectEstado.classList.remove('hidden');
        selectEstado.name = 'entidad_nacimiento';
        inputTexto.classList.add('hidden');
        inputTexto.name = '';
    } else {
        selectEstado.classList.add('hidden');
        selectEstado.name = '';
        inputTexto.classList.remove('hidden');
        inputTexto.name = 'entidad_nacimiento';
    }
}

// Ejecutar al cargar por si viene con old()
document.addEventListener('DOMContentLoaded', toggleEstados);
</script>

@endsection