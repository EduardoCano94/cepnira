@extends('layouts.app')
@section('titulo', 'Editar Cédula')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Editar Cédula de Registro</h2>
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
    $nivelActual = old('nivel', 'primaria'); // En edit se podría derivar del grado, primaria es default
    @endphp

    <form method="POST" action="{{ route('alumnos.update', $alumno) }}">
    @csrf
    @method('PUT')

    {{-- ENCABEZADO --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ciclo Escolar *</label>
                <input type="text" name="ciclo_escolar" value="{{ old('ciclo_escolar', $alumno->ciclo_escolar) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha</label>
                <input type="date" name="fecha_cedula" value="{{ old('fecha_cedula', $alumno->fecha_cedula) }}"
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
                <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $alumno->apellido_paterno) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Materno *</label>
                <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $alumno->apellido_materno) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre(s) *</label>
                <input type="text" name="nombre" value="{{ old('nombre', $alumno->nombre) }}"
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
                <input type="text" name="curp" value="{{ old('curp', $alumno->curp) }}" maxlength="18"
                    class="w-full border rounded-lg px-3 py-2 text-sm uppercase focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha de Nacimiento *</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Género *</label>
                <select name="genero" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    <option value="H" {{ old('genero', $alumno->genero)=='H' ? 'selected' : '' }}>H — Hombre</option>
                    <option value="M" {{ old('genero', $alumno->genero)=='M' ? 'selected' : '' }}>M — Mujer</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">País de Nacimiento</label>
                <select name="pais_nacimiento" id="pais_nacimiento" onchange="toggleEstados()"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="México" {{ old('pais_nacimiento', $alumno->pais_nacimiento)=='México' ? 'selected' : '' }}>México</option>
                    <option value="Otro" {{ old('pais_nacimiento', $alumno->pais_nacimiento)=='Otro' ? 'selected' : '' }}>Otro país</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Entidad de Nacimiento *</label>
                <select name="entidad_nacimiento" id="entidad_nacimiento"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado }}" {{ old('entidad_nacimiento', $alumno->entidad_nacimiento)==$estado ? 'selected' : '' }}>{{ $estado }}</option>
                    @endforeach
                </select>
                <input type="text" name="entidad_nacimiento_texto" id="entidad_nacimiento_texto"
                    placeholder="Escriba el país de nacimiento" value="{{ old('entidad_nacimiento_texto', $alumno->entidad_nacimiento) }}"
                    class="hidden w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none mt-1">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tipo de Sangre</label>
                <select name="tipo_sangre" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($tiposSangre as $tipo)
                        <option value="{{ $tipo }}" {{ old('tipo_sangre', $alumno->tipo_sangre)==$tipo ? 'selected' : '' }}>{{ $tipo }}</option>
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
                        <option value="{{ $lengua }}" {{ old('lengua_materna', $alumno->lengua_materna)==$lengua ? 'selected' : '' }}>{{ $lengua }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Discapacidad / Aptitud diferenciada</label>
                <input type="text" name="discapacidad" value="{{ old('discapacidad', $alumno->discapacidad) }}" placeholder="Especificar o dejar vacío"
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
                <input type="text" name="padre_apellido_paterno" value="{{ old('padre_apellido_paterno', $alumno->padre?->apellido_paterno) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Materno</label>
                <input type="text" name="padre_apellido_materno" value="{{ old('padre_apellido_materno', $alumno->padre?->apellido_materno) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre(s) *</label>
                <input type="text" name="padre_nombre" value="{{ old('padre_nombre', $alumno->padre?->nombre) }}"
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
                <input type="text" name="padre_curp" value="{{ old('padre_curp', $alumno->padre?->curp) }}" maxlength="18"
                    class="w-full border rounded-lg px-3 py-2 text-sm uppercase focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha de Nacimiento</label>
                <input type="date" name="padre_fecha_nacimiento" value="{{ old('padre_fecha_nacimiento', $alumno->padre?->fecha_nacimiento) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nivel de Estudios</label>
                <select name="padre_nivel_estudios" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($nivelesEstudio as $nivel)
                        <option value="{{ $nivel }}" {{ old('padre_nivel_estudios', $alumno->padre?->nivel_estudios)==$nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Celular</label>
                <input type="text" name="padre_tel_celular" value="{{ old('padre_tel_celular', $alumno->padre?->tel_celular) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Fijo</label>
                <input type="text" name="padre_tel_fijo" value="{{ old('padre_tel_fijo', $alumno->padre?->tel_fijo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Correo electrónico</label>
                <input type="email" name="padre_email" value="{{ old('padre_email', $alumno->padre?->email) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ocupación</label>
                <input type="text" name="padre_ocupacion" value="{{ old('padre_ocupacion', $alumno->padre?->ocupacion) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio</label>
                <input type="text" name="padre_municipio" value="{{ old('padre_municipio', $alumno->padre?->municipio) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Localidad</label>
                <input type="text" name="padre_localidad" value="{{ old('padre_localidad', $alumno->padre?->localidad) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CP</label>
                <input type="text" name="padre_cp" value="{{ old('padre_cp', $alumno->padre?->cp) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="col-span-3">
                <label class="block text-xs font-medium text-gray-600 mb-1">Colonia</label>
                <input type="text" name="padre_colonia" value="{{ old('padre_colonia', $alumno->padre?->colonia) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-600 mb-1">Calle</label>
                <input type="text" name="padre_calle" value="{{ old('padre_calle', $alumno->padre?->calle) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Núm. Ext.</label>
                <input type="text" name="padre_num_ext" value="{{ old('padre_num_ext', $alumno->padre?->num_ext) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Núm. Int.</label>
                <input type="text" name="padre_num_int" value="{{ old('padre_num_int', $alumno->padre?->num_int) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Horario</label>
                <input type="text" name="padre_horario" value="{{ old('padre_horario', $alumno->padre?->horario) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">E-mail Trabajo</label>
                <input type="email" name="padre_email_trabajo" value="{{ old('padre_email_trabajo', $alumno->padre?->email_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Trabajo</label>
                <input type="text" name="padre_tel_trabajo" value="{{ old('padre_tel_trabajo', $alumno->padre?->tel_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ext.</label>
                <input type="text" name="padre_ext_trabajo" value="{{ old('padre_ext_trabajo', $alumno->padre?->ext_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="padre_vive" {{ old('padre_vive', $alumno->padre?->vive_con_alumno) ? 'checked' : '' }}> Vive con el alumno</label>
    </div>

    {{-- DATOS DE LA MADRE --}}
    <div class="bg-white rounded-xl shadow p-6 mb-4">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 text-sm uppercase">Datos de la Madre</h3>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Paterno *</label>
                <input type="text" name="madre_apellido_paterno" value="{{ old('madre_apellido_paterno', $alumno->madre?->apellido_paterno) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Materno</label>
                <input type="text" name="madre_apellido_materno" value="{{ old('madre_apellido_materno', $alumno->madre?->apellido_materno) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre(s) *</label>
                <input type="text" name="madre_nombre" value="{{ old('madre_nombre', $alumno->madre?->nombre) }}"
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
                <input type="text" name="madre_curp" value="{{ old('madre_curp', $alumno->madre?->curp) }}" maxlength="18"
                    class="w-full border rounded-lg px-3 py-2 text-sm uppercase focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha de Nacimiento</label>
                <input type="date" name="madre_fecha_nacimiento" value="{{ old('madre_fecha_nacimiento', $alumno->madre?->fecha_nacimiento) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nivel de Estudios</label>
                <select name="madre_nivel_estudios" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($nivelesEstudio as $nivel)
                        <option value="{{ $nivel }}" {{ old('madre_nivel_estudios', $alumno->madre?->nivel_estudios)==$nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Celular</label>
                <input type="text" name="madre_tel_celular" value="{{ old('madre_tel_celular', $alumno->madre?->tel_celular) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Fijo</label>
                <input type="text" name="madre_tel_fijo" value="{{ old('madre_tel_fijo', $alumno->madre?->tel_fijo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Correo electrónico</label>
                <input type="email" name="madre_email" value="{{ old('madre_email', $alumno->madre?->email) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ocupación</label>
                <input type="text" name="madre_ocupacion" value="{{ old('madre_ocupacion', $alumno->madre?->ocupacion) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
           <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio</label>
                <input type="text" name="madre_municipio" value="{{ old('madre_municipio', $alumno->madre?->municipio) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Localidad</label>
                <input type="text" name="madre_localidad" value="{{ old('madre_localidad', $alumno->madre?->localidad) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CP</label>
                <input type="text" name="madre_cp" value="{{ old('madre_cp', $alumno->madre?->cp) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="col-span-3">
                <label class="block text-xs font-medium text-gray-600 mb-1">Colonia</label>
                <input type="text" name="madre_colonia" value="{{ old('madre_colonia', $alumno->madre?->colonia) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="col-span-2">
                <label class="block text-xs font-medium text-gray-600 mb-1">Calle</label>
                <input type="text" name="madre_calle" value="{{ old('madre_calle', $alumno->madre?->calle) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Núm. Ext.</label>
                <input type="text" name="madre_num_ext" value="{{ old('madre_num_ext', $alumno->madre?->num_ext) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Núm. Int.</label>
                <input type="text" name="madre_num_int" value="{{ old('madre_num_int', $alumno->madre?->num_int) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Horario</label>
                <input type="text" name="madre_horario" value="{{ old('madre_horario', $alumno->madre?->horario) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">E-mail Trabajo</label>
                <input type="email" name="madre_email_trabajo" value="{{ old('madre_email_trabajo', $alumno->madre?->email_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Trabajo</label>
                <input type="text" name="madre_tel_trabajo" value="{{ old('madre_tel_trabajo', $alumno->madre?->tel_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ext.</label>
                <input type="text" name="madre_ext_trabajo" value="{{ old('madre_ext_trabajo', $alumno->madre?->ext_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="madre_vive" {{ old('madre_vive', $alumno->madre?->vive_con_alumno) ? 'checked' : '' }}> Vive con el alumno</label>
    </div>

    {{-- TUTOR DIFERENTE --}}
<div class="bg-white rounded-xl shadow p-6 mb-4">
    <div class="flex items-center gap-3 mb-2">
        <input type="checkbox" name="tutor_diferente" id="tutor_diferente"
            {{ old('tutor_diferente', $alumno->tutor ? '1' : '') ? 'checked' : '' }} onchange="toggleTutor()">
        <label for="tutor_diferente" class="font-bold text-sm text-gray-700 uppercase cursor-pointer">
            El tutor es diferente al padre o madre
        </label>
    </div>

    <div id="seccion_tutor" class="{{ old('tutor_diferente', $alumno->tutor ? '1' : '') ? '' : 'hidden' }}">
        <h3 class="font-bold text-white bg-red-700 px-3 py-1 rounded mb-4 mt-4 text-sm uppercase">Datos del Tutor</h3>

        {{-- Fila 1: Apellidos y Nombre + Parentesco --}}
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Paterno</label>
                <input type="text" name="tutor_apellido_paterno" value="{{ old('tutor_apellido_paterno', $alumno->tutor?->apellido_paterno) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Apellido Materno</label>
                <input type="text" name="tutor_apellido_materno" value="{{ old('tutor_apellido_materno', $alumno->tutor?->apellido_materno) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nombre(s)</label>
                <input type="text" name="tutor_nombre" value="{{ old('tutor_nombre', $alumno->tutor?->nombre) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Parentesco</label>
                <input type="text" name="tutor_parentesco" value="{{ old('tutor_parentesco', $alumno->tutor?->parentesco) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- Fila 2: CURP + Fecha de Nacimiento + País de Nacimiento + Nivel de Estudios --}}
        <div class="grid grid-cols-4 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">
                    CURP
                    <a href="https://www.gob.mx/curp/" target="_blank"
                       class="ml-1 text-blue-600 hover:text-blue-800 border border-blue-300 rounded px-1 text-xs font-normal">
                        🔗 Consultar
                    </a>
                </label>
                <input type="text" name="tutor_curp" value="{{ old('tutor_curp', $alumno->tutor?->curp) }}" maxlength="18"
                    class="w-full border rounded-lg px-3 py-2 text-sm uppercase focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Fecha de Nacimiento</label>
                <input type="date" name="tutor_fecha_nacimiento" value="{{ old('tutor_fecha_nacimiento', $alumno->tutor?->fecha_nacimiento) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">País de Nacimiento</label>
                <input type="text" name="tutor_pais_nacimiento" value="{{ old('tutor_pais_nacimiento', $alumno->tutor?->pais_nacimiento ?? 'México') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Nivel de Estudios</label>
                <select name="tutor_nivel_estudios"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">-- Seleccionar --</option>
                    <option value="primaria"       {{ old('tutor_nivel_estudios', $alumno->tutor?->nivel_estudios) == 'primaria'       ? 'selected' : '' }}>Primaria</option>
                    <option value="secundaria"     {{ old('tutor_nivel_estudios', $alumno->tutor?->nivel_estudios) == 'secundaria'     ? 'selected' : '' }}>Secundaria</option>
                    <option value="preparatoria"   {{ old('tutor_nivel_estudios', $alumno->tutor?->nivel_estudios) == 'preparatoria'   ? 'selected' : '' }}>Preparatoria / Bachillerato</option>
                    <option value="tecnico"        {{ old('tutor_nivel_estudios', $alumno->tutor?->nivel_estudios) == 'tecnico'        ? 'selected' : '' }}>Técnico</option>
                    <option value="licenciatura"   {{ old('tutor_nivel_estudios', $alumno->tutor?->nivel_estudios) == 'licenciatura'   ? 'selected' : '' }}>Licenciatura</option>
                    <option value="posgrado"       {{ old('tutor_nivel_estudios', $alumno->tutor?->nivel_estudios) == 'posgrado'       ? 'selected' : '' }}>Posgrado</option>
                </select>
            </div>
        </div>

        {{-- Fila 3: Vive con alumno + Tutor legal --}}
        <div class="flex gap-8 mb-4">
            <div>
                <span class="block text-xs font-medium text-gray-600 mb-2">Vive con el alumno</span>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="tutor_vive_alumno" value="1" {{ old('tutor_vive_alumno', $alumno->tutor?->vive_con_alumno ? '1' : '0') == '1' ? 'checked' : '' }}> Sí
                    </label>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="tutor_vive_alumno" value="0" {{ old('tutor_vive_alumno', $alumno->tutor?->vive_con_alumno ? '1' : '0') == '0' ? 'checked' : '' }}> No
                    </label>
                </div>
            </div>
            <div>
                <span class="block text-xs font-medium text-gray-600 mb-2">¿Es tutor legal?</span>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="tutor_es_legal" value="1" {{ old('tutor_es_legal', $alumno->tutor?->es_tutor_legal ? '1' : '0') == '1' ? 'checked' : '' }}> Sí
                    </label>
                    <label class="flex items-center gap-2 text-sm">
                        <input type="radio" name="tutor_es_legal" value="0" {{ old('tutor_es_legal', $alumno->tutor?->es_tutor_legal ? '1' : '0') == '0' ? 'checked' : '' }}> No
                    </label>
                </div>
            </div>
        </div>

        {{-- DIRECCIÓN --}}
        <h4 class="font-bold text-sm text-gray-700 uppercase mb-3 border-b pb-1">Dirección</h4>

        {{-- Fila 4: País de residencia + Entidad --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">País de Residencia</label>
                <input type="text" name="tutor_pais_residencia" value="{{ old('tutor_pais_residencia', $alumno->tutor?->pais_residencia ?? 'México') }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Entidad</label>
                <input type="text" name="tutor_entidad" value="{{ old('tutor_entidad', $alumno->tutor?->entidad) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- Fila 5: Municipio + Localidad --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio</label>
                <input type="text" name="tutor_municipio" value="{{ old('tutor_municipio', $alumno->tutor?->municipio) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Localidad</label>
                <input type="text" name="tutor_localidad" value="{{ old('tutor_localidad', $alumno->tutor?->localidad) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- Fila 6: CP + Colonia --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CP</label>
                <input type="text" name="tutor_cp" value="{{ old('tutor_cp', $alumno->tutor?->cp) }}" maxlength="5"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Colonia</label>
                <input type="text" name="tutor_colonia" value="{{ old('tutor_colonia', $alumno->tutor?->colonia) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- Fila 7: Calle + Núm. Ext + Núm. Int --}}
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="col-span-1">
                <label class="block text-xs font-medium text-gray-600 mb-1">Calle</label>
                <input type="text" name="tutor_calle" value="{{ old('tutor_calle', $alumno->tutor?->calle) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Núm. Ext.</label>
                <input type="text" name="tutor_num_ext" value="{{ old('tutor_num_ext', $alumno->tutor?->num_ext) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Núm. Int.</label>
                <input type="text" name="tutor_num_int" value="{{ old('tutor_num_int', $alumno->tutor?->num_int) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- Fila 8: Tel. Fijo + Tel. Celular + E-mail --}}
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Fijo</label>
                <input type="text" name="tutor_tel_fijo" value="{{ old('tutor_tel_fijo', $alumno->tutor?->tel_fijo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Celular</label>
                <input type="text" name="tutor_tel_celular" value="{{ old('tutor_tel_celular', $alumno->tutor?->tel_celular) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">E-mail</label>
                <input type="email" name="tutor_email" value="{{ old('tutor_email', $alumno->tutor?->email) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- Fila 9: Ocupación + Horario --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ocupación</label>
                <input type="text" name="tutor_ocupacion" value="{{ old('tutor_ocupacion', $alumno->tutor?->ocupacion) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Horario</label>
                <input type="text" name="tutor_horario" value="{{ old('tutor_horario', $alumno->tutor?->horario) }}"
                    placeholder="Ej. 8:00 - 17:00"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- Fila 10: Tel. Trabajo + Ext + E-mail Trabajo --}}
        <div class="grid grid-cols-3 gap-4 mb-2">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Tel. Trabajo</label>
                <input type="text" name="tutor_tel_trabajo" value="{{ old('tutor_tel_trabajo', $alumno->tutor?->tel_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Ext.</label>
                <input type="text" name="tutor_ext_trabajo" value="{{ old('tutor_ext_trabajo', $alumno->tutor?->ext_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">E-mail Trabajo</label>
                <input type="email" name="tutor_email_trabajo" value="{{ old('tutor_email_trabajo', $alumno->tutor?->email_trabajo) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
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
                        <option value="{{ $estado }}" {{ old('entidad_fed_registro', $alumno->documentoProbatorio?->entidad_fed_registro)==$estado ? 'selected' : '' }}>{{ $estado }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Municipio de Registro <span class="text-gray-400">(2)</span></label>
                <input type="text" name="municipio_registro" value="{{ old('municipio_registro', $alumno->documentoProbatorio?->municipio_registro) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Año de Registro <span class="text-gray-400">(3)</span></label>
                <select name="año_registro" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @for($y = date('Y'); $y >= 1990; $y--)
                        <option value="{{ $y }}" {{ old('año_registro', $alumno->documentoProbatorio?->año_registro)==$y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>

        {{-- Tipo de documento --}}
        <div class="grid grid-cols-4 gap-3 mb-4 border rounded-lg p-3 bg-gray-50 text-xs font-semibold">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="tipo_documento" value="acta_nacimiento"
                    {{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='acta_nacimiento' ? 'checked' : '' }}
                    onchange="cambiarDocumento('acta_nacimiento')">
                ACTA DE NACIMIENTO
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="tipo_documento" value="documento_migratorio"
                    {{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='documento_migratorio' ? 'checked' : '' }}
                    onchange="cambiarDocumento('documento_migratorio')">
                DOCUMENTO MIGRATORIO
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="tipo_documento" value="naturalizacion_sre"
                    {{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='naturalizacion_sre' ? 'checked' : '' }}
                    onchange="cambiarDocumento('naturalizacion_sre')">
                DOCUMENTO DE NATURALIZACIÓN DE LA SRE
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="tipo_documento" value="ficha_signaletica"
                    {{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='ficha_signaletica' ? 'checked' : '' }}
                    onchange="cambiarDocumento('ficha_signaletica')">
                FICHA SIGNALÉTICA
            </label>
        </div>

        {{-- Campos dinámicos según tipo --}}
        <div id="campos_acta" class="{{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='acta_nacimiento' ? '' : 'hidden' }} grid grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. de Libro <span class="text-gray-400">(4)</span></label>
                <input type="text" name="num_libro" value="{{ old('num_libro', $alumno->documentoProbatorio?->num_libro) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. de Acta</label>
                <input type="text" name="num_acta" value="{{ old('num_acta', $alumno->documentoProbatorio?->num_acta) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CRIP</label>
                <input type="text" name="crip" value="{{ old('crip', $alumno->documentoProbatorio?->crip) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div id="campos_migratorio" class="{{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='documento_migratorio' ? '' : 'hidden' }} grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. Registro Nacional de Extranjeros <span class="text-gray-400">(5)</span></label>
                <input type="text" name="num_registro_extranjeros" value="{{ old('num_registro_extranjeros', $alumno->documentoProbatorio?->num_registro_extranjeros) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div id="campos_naturalizacion" class="{{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='naturalizacion_sre' ? '' : 'hidden' }} grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Folio de la Carta <span class="text-gray-400">(6)</span></label>
                <input type="text" name="folio_carta" value="{{ old('folio_carta', $alumno->documentoProbatorio?->folio_carta) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <div id="campos_signaletica" class="{{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='ficha_signaletica' ? '' : 'hidden' }} grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">No. de Juzgado <span class="text-gray-400">(7)</span></label>
                <input type="text" name="num_juzgado" value="{{ old('num_juzgado', $alumno->documentoProbatorio?->num_juzgado) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Folio de la Ficha</label>
                <input type="text" name="folio_ficha" value="{{ old('folio_ficha', $alumno->documentoProbatorio?->folio_ficha) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        {{-- No entregó documento --}}
        <div class="mt-3">
            <label class="flex items-center gap-2 text-xs font-semibold cursor-pointer border rounded px-3 py-2 w-fit bg-gray-50">
                <input type="radio" name="tipo_documento" value="no_entrego"
                    {{ old('tipo_documento', $alumno->documentoProbatorio?->tipo_documento)=='no_entrego' ? 'checked' : '' }}
                    onchange="cambiarDocumento('no_entrego')">
                NO ENTREGÓ DOCUMENTO PROBATORIO <span class="text-gray-400 ml-1">(8)</span>
            </label>
        </div>

        <div class="mt-4">
            <label class="block text-xs font-medium text-gray-600 mb-1">Observaciones</label>
            <input type="text" name="doc_observaciones" value="{{ old('doc_observaciones', $alumno->documentoProbatorio?->observaciones) }}"
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
                <input type="text" name="nombre_escuela" value="{{ old('nombre_escuela', $alumno->escuela?->nombre_escuela) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">CCT</label>
                <input type="text" name="cct" value="{{ old('cct', $alumno->escuela?->cct) }}" placeholder="Ej. 21DPR0001A"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Turno</label>
                <select name="turno" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    <option value="matutino" {{ old('turno', $alumno->escuela?->turno)=='matutino' ? 'selected' : '' }}>Matutino</option>
                    <option value="vespertino" {{ old('turno', $alumno->escuela?->turno)=='vespertino' ? 'selected' : '' }}>Vespertino</option>
                    <option value="nocturno" {{ old('turno', $alumno->escuela?->turno)=='nocturno' ? 'selected' : '' }}>Nocturno</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Grado *</label>
                <select name="grado" id="select_grado" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($gradosPorNivel[$nivelActual] as $grado)
                        <option value="{{ $grado }}" {{ old('grado', $alumno->escuela?->grado)==$grado ? 'selected' : '' }}>{{ $grado }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Grupo</label>
                <select name="grupo" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Seleccionar</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo }}" {{ old('grupo', $alumno->escuela?->grupo)==$grupo ? 'selected' : '' }}>{{ $grupo }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">ZE</label>
                <input type="text" name="ze" value="{{ old('ze', $alumno->escuela?->ze) }}" placeholder="Zona Escolar"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>
    </div>

    {{-- BOTONES --}}
    <div class="flex gap-3 justify-end mb-8">
        <a href="{{ route('alumnos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm">Cancelar</a>
        <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white px-6 py-2 rounded-lg text-sm font-semibold">Guardar Cambios</button>
    </div>

    </form>
</div>

<script>
// ── MAPA CURP → nombre de entidad (igual que el array $estados del blade) ──
const CURP_ENTIDAD = {
    AS:'Aguascalientes',  BC:'Baja California',    BS:'Baja California Sur',
    CC:'Campeche',        CS:'Chiapas',             CH:'Chihuahua',
    DF:'Ciudad de México',MC:'Ciudad de México',    // DF legacy + CDMX
    CL:'Coahuila',        CM:'Colima',              DG:'Durango',
    GT:'Guanajuato',      GR:'Guerrero',            HG:'Hidalgo',
    JC:'Jalisco',         MN:'Michoacán',           MS:'Morelos',
    NT:'Nayarit',         NL:'Nuevo León',          OC:'Oaxaca',
    PL:'Puebla',          QT:'Querétaro',           QR:'Quintana Roo',
    SP:'San Luis Potosí', SL:'Sinaloa',             SR:'Sonora',
    TC:'Tabasco',         TS:'Tamaulipas',          TL:'Tlaxcala',
    VZ:'Veracruz',        YN:'Yucatán',             ZS:'Zacatecas',
    NE:'Nacido en el Extranjero',
    EM:'Estado de México',MX:'Estado de México',
};

// ── Decodificar CURP ──
function decodificarCURP(curp) {
    if (!curp || curp.length < 18) return null;
    curp = curp.toUpperCase();
    const anio2    = curp.substring(4, 6);
    const mes      = curp.substring(6, 8);
    const dia      = curp.substring(8, 10);
    const genero   = curp.charAt(10);
    const claveEnt = curp.substring(11, 13);
    const anioNum  = parseInt(anio2);
    const actual   = new Date().getFullYear() % 100;
    const siglo    = anioNum <= actual ? '20' : '19';
    return {
        fecha:   `${siglo}${anio2}-${mes}-${dia}`,
        genero:  genero === 'H' ? 'H' : 'M',
        entidad: CURP_ENTIDAD[claveEnt] || null,
    };
}

// ── Aplicar CURP al formulario del alumno ──
function aplicarCURPAlumno(curp) {
    const datos = decodificarCURP(curp);
    if (!datos) return;

    // Fecha nacimiento
    const fNac = document.querySelector('[name="fecha_nacimiento"]');
    if (fNac && !fNac.value) fNac.value = datos.fecha;

    // Género (select con name="genero", sin id)
    const genSel = document.querySelector('[name="genero"]');
    if (genSel && !genSel.value) genSel.value = datos.genero;

    // Entidad (solo si pais = México)
    if (datos.entidad) {
        const pais = document.getElementById('pais_nacimiento');
        if (!pais || pais.value === 'México') {
            const entSel = document.getElementById('entidad_nacimiento');
            if (entSel && !entSel.value) {
                // Buscar opción ignorando acentos
                const norm = s => s.normalize('NFD').replace(/[\u0300-\u036f]/g,'').toLowerCase().trim();
                const obj  = norm(datos.entidad);
                for (const opt of entSel.options) {
                    if (norm(opt.value) === obj || norm(opt.text) === obj) {
                        entSel.value = opt.value;
                        break;
                    }
                }
            }
        }
    }
}

// ── Buscar CP → dirección (API pública zippopotam.us para MX) ──
// Usamos la API de Sepomex a través del endpoint sin CORS issues
async function buscarCodigoPostal(cp, prefijo) {
    if (!cp || cp.length !== 5) return;

    const campoEstado    = document.querySelector(`[name="${prefijo}_entidad"]`);
    const campoMunicipio = document.querySelector(`[name="${prefijo}_municipio"]`);
    const campoLocalidad = document.querySelector(`[name="${prefijo}_localidad"]`);
    const campoColonia   = document.querySelector(`[name="${prefijo}_colonia"]`);
    const campoPais      = document.querySelector(`[name="${prefijo}_pais_residencia"]`);

    // Indicador visual
    const cpInput = document.querySelector(`[name="${prefijo}_cp"]`);
    if (cpInput) { cpInput.classList.add('bg-yellow-50'); cpInput.title = 'Buscando...'; }

    try {
        // zippopotam.us soporta México con código MX y no tiene CORS
        const res = await fetch(`https://api.zippopotam.us/mx/${cp}`);
        if (!res.ok) throw new Error('CP no encontrado');
        const data = await res.json();

        const lugar = data.places?.[0];
        if (!lugar) throw new Error('Sin datos');

        if (campoPais   && !campoPais.value)   campoPais.value   = 'México';
        if (campoEstado && !campoEstado.value)  campoEstado.value = lugar['state'] || '';
        if (campoMunicipio && !campoMunicipio.value)
            campoMunicipio.value = lugar['place name'] || '';
        if (campoLocalidad && !campoLocalidad.value)
            campoLocalidad.value = lugar['place name'] || '';

        // zippopotam no da colonias; intentamos con la API de sepomex pública
        await buscarColonias(cp, campoColonia);

    } catch(e) {
        // Fallback: intentar con sepomex directamente
        await buscarConSepomex(cp, prefijo);
    }

    if (cpInput) { cpInput.classList.remove('bg-yellow-50'); cpInput.title = ''; }
}

async function buscarColonias(cp, campoColonia) {
    try {
        const res  = await fetch(`https://sepomex.icalialabs.com/api/v1/zip_codes?zip_code=${cp}&per_page=100`);
        const data = await res.json();
        const colonias = (data?.zip_codes || []).map(r => r.d_asenta).filter(Boolean);
        if (colonias.length && campoColonia) poblarDatalist(campoColonia, colonias);
    } catch(e) { /* silencioso, colonias son opcionales */ }
}

async function buscarConSepomex(cp, prefijo) {
    try {
        const res  = await fetch(`https://sepomex.icalialabs.com/api/v1/zip_codes?zip_code=${cp}&per_page=100`);
        const data = await res.json();
        const registros = data?.zip_codes;
        if (!registros?.length) return;
        const primero = registros[0];

        const set = (name, val) => {
            const el = document.querySelector(`[name="${prefijo}_${name}"]`);
            if (el && !el.value && val) el.value = val;
        };
        set('pais_residencia', 'México');
        set('entidad',   primero.d_estado);
        set('municipio', primero.d_mnpio);
        set('localidad', primero.d_ciudad || primero.d_mnpio);

        const colonias = registros.map(r => r.d_asenta).filter(Boolean);
        const colInput = document.querySelector(`[name="${prefijo}_colonia"]`);
        if (colInput) poblarDatalist(colInput, colonias);
    } catch(e) { /* silencioso */ }
}

function poblarDatalist(input, opciones) {
    const id = `dl_${input.name}`;
    let dl = document.getElementById(id);
    if (!dl) {
        dl = document.createElement('datalist');
        dl.id = id;
        input.setAttribute('list', id);
        input.parentElement.appendChild(dl);
    }
    dl.innerHTML = opciones.map(o => `<option value="${o}">`).join('');
}

// ── Registrar escuchas en campos CP ──
function registrarEventosCP() {
    ['padre', 'madre', 'tutor'].forEach(prefijo => {
        const el = document.querySelector(`[name="${prefijo}_cp"]`);
        if (!el) return;
        // Solo números
        el.addEventListener('keypress', e => { if (!/\d/.test(e.key)) e.preventDefault(); });
        // Buscar al completar 5 dígitos
        let timer;
        el.addEventListener('input', function() {
            const val = this.value.replace(/\D/g,'').slice(0,5);
            this.value = val;
            clearTimeout(timer);
            if (val.length === 5) timer = setTimeout(() => buscarCodigoPostal(val, prefijo), 700);
        });
    });
}

// ── CURP → autocomplete al escribir los 18 chars ──
function registrarEventosCURP() {
    const curpAlumno = document.querySelector('[name="curp"]');
    if (curpAlumno) {
        curpAlumno.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
            if (this.value.length === 18) aplicarCURPAlumno(this.value);
        });
        // También al pegar
        curpAlumno.addEventListener('paste', function() {
            setTimeout(() => {
                this.value = this.value.toUpperCase().trim();
                if (this.value.length === 18) aplicarCURPAlumno(this.value);
            }, 50);
        });
    }
    // CURP padre/madre/tutor: solo mayúsculas
    document.querySelectorAll('[name$="_curp"]').forEach(el => {
        el.addEventListener('input', function() { this.value = this.value.toUpperCase(); });
        el.addEventListener('paste', function() {
            setTimeout(() => { this.value = this.value.toUpperCase().trim(); }, 50);
        });
    });
}

// ── FUNCIONES ORIGINALES ──
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
    ['acta','migratorio','naturalizacion','signaletica'].forEach(t =>
        document.getElementById('campos_' + t)?.classList.add('hidden')
    );
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
    const sel  = document.getElementById('entidad_nacimiento');
    const txt  = document.getElementById('entidad_nacimiento_texto');
    if (pais === 'México') {
        sel.classList.remove('hidden'); sel.name = 'entidad_nacimiento';
        txt.classList.add('hidden');    txt.name = '';
    } else {
        sel.classList.add('hidden');    sel.name = '';
        txt.classList.remove('hidden'); txt.name = 'entidad_nacimiento';
    }
}

function validarFechaPadre(campo, label) {
    const fAlumno = document.querySelector('[name="fecha_nacimiento"]');
    if (!fAlumno?.value || !campo.value) { campo.setCustomValidity(''); ocultarErrorFecha(campo); return; }
    if (new Date(campo.value) >= new Date(fAlumno.value)) {
        const msg = `La fecha de nacimiento del ${label} debe ser anterior a la del alumno.`;
        campo.setCustomValidity(msg); mostrarErrorFecha(campo, msg);
    } else { campo.setCustomValidity(''); ocultarErrorFecha(campo); }
}

function mostrarErrorFecha(input, msg) {
    let err = input.parentElement.querySelector('.fecha-error');
    if (!err) { err = document.createElement('p'); err.className = 'fecha-error text-red-600 text-xs mt-1'; input.parentElement.appendChild(err); }
    err.textContent = msg; input.classList.add('border-red-500');
}

function ocultarErrorFecha(input) {
    input.parentElement.querySelector('.fecha-error')?.remove();
    input.classList.remove('border-red-500');
}

// ── INIT ──
document.addEventListener('DOMContentLoaded', function() {
    toggleEstados();
    const docSelec = document.querySelector('input[name="tipo_documento"]:checked');
    if (docSelec) cambiarDocumento(docSelec.value);

    registrarEventosCURP();
    registrarEventosCP();

    const camposFecha = [
        ['padre_fecha_nacimiento','padre'],
        ['madre_fecha_nacimiento','madre'],
        ['tutor_fecha_nacimiento','tutor'],
    ];
    const fAlumno = document.querySelector('[name="fecha_nacimiento"]');
    camposFecha.forEach(([name, label]) => {
        const campo = document.querySelector(`[name="${name}"]`);
        if (!campo) return;
        campo.addEventListener('change', () => validarFechaPadre(campo, label));
        fAlumno?.addEventListener('change', () => validarFechaPadre(campo, label));
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        let error = false;
        camposFecha.forEach(([name, label]) => {
            const campo = document.querySelector(`[name="${name}"]`);
            if (campo) { validarFechaPadre(campo, label); if (campo.validationMessage) error = true; }
        });
        if (error) e.preventDefault();
    });
});
</script>


@endsection