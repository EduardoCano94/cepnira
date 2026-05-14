<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Expediente;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumno::with('expediente', 'escuela');

        if ($request->buscar) {
            $query->where('nombre', 'like', "%{$request->buscar}%")
                  ->orWhere('apellido_paterno', 'like', "%{$request->buscar}%")
                  ->orWhere('curp', 'like', "%{$request->buscar}%");
        }

        $alumnos = $query->paginate(15);
        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        $fechaAlumno = $request->fecha_nacimiento;

        $request->validate([
            'ciclo_escolar'          => 'required|string',
            'fecha_cedula'           => 'required|date',
            'apellido_paterno'       => 'required|string|max:100',
            'apellido_materno'       => 'required|string|max:100',
            'nombre'                 => 'required|string|max:100',
            'curp'                   => 'required|string|size:18|unique:alumnos',
            'fecha_nacimiento'       => 'required|date|before:today',
            'entidad_nacimiento'     => 'required|string',
            'genero'                 => 'required|in:H,M',
            'padre_apellido_paterno' => 'required|string',
            'padre_nombre'           => 'required|string',
            'padre_fecha_nacimiento' => [
                'nullable', 'date',
                'before:' . $fechaAlumno,
            ],
            'madre_apellido_paterno' => 'required|string',
            'madre_nombre'           => 'required|string',
            'madre_fecha_nacimiento' => [
                'nullable', 'date',
                'before:' . $fechaAlumno,
            ],
            'tutor_fecha_nacimiento' => [
                'nullable', 'date',
                'before:' . $fechaAlumno,
            ],
            'nombre_escuela'         => 'required|string',
            'grado'                  => 'required|string',
        ], [
            'padre_fecha_nacimiento.before' => 'La fecha de nacimiento del padre debe ser anterior a la del alumno.',
            'madre_fecha_nacimiento.before' => 'La fecha de nacimiento de la madre debe ser anterior a la del alumno.',
            'tutor_fecha_nacimiento.before' => 'La fecha de nacimiento del tutor debe ser anterior a la del alumno.',
            'fecha_nacimiento.before'       => 'La fecha de nacimiento del alumno no puede ser en el futuro.',
        ]);

        // 1. Alumno
        $alumno = Alumno::create([
            'ciclo_escolar'      => $request->ciclo_escolar,
            'fecha_cedula'       => $request->fecha_cedula,
            'apellido_paterno'   => $request->apellido_paterno,
            'apellido_materno'   => $request->apellido_materno,
            'nombre'             => $request->nombre,
            'curp'               => strtoupper($request->curp),
            'fecha_nacimiento'   => $request->fecha_nacimiento,
            'pais_nacimiento'    => $request->pais_nacimiento ?? 'México',
            'entidad_nacimiento' => $request->entidad_nacimiento,
            'genero'             => $request->genero,
            'discapacidad'       => $request->discapacidad,
            'tipo_sangre'        => $request->tipo_sangre,
            'lengua_materna'     => $request->lengua_materna,
        ]);

        // 2. Padre
        $alumno->padre()->create([
            'tipo'             => 'padre',
            'apellido_paterno' => $request->padre_apellido_paterno,
            'apellido_materno' => $request->padre_apellido_materno,
            'nombre'           => $request->padre_nombre,
            'curp'             => $request->padre_curp,
            'fecha_nacimiento' => $request->padre_fecha_nacimiento,
            'nivel_estudios'   => $request->padre_nivel_estudios,
            'vive_con_alumno'  => $request->has('padre_vive'),
            'es_tutor'         => $request->has('padre_es_tutor'),
            'es_finado'        => $request->has('padre_es_finado'),
            'tel_celular'      => $request->padre_tel_celular,
            'tel_fijo'         => $request->padre_tel_fijo,
            'email'            => $request->padre_email,
            'ocupacion'        => $request->padre_ocupacion,
            'municipio'        => $request->padre_municipio,
            'colonia'          => $request->padre_colonia,
            'calle'            => $request->padre_calle,
        ]);

        // 3. Madre
        $alumno->madre()->create([
            'tipo'             => 'madre',
            'apellido_paterno' => $request->madre_apellido_paterno,
            'apellido_materno' => $request->madre_apellido_materno,
            'nombre'           => $request->madre_nombre,
            'curp'             => $request->madre_curp,
            'fecha_nacimiento' => $request->madre_fecha_nacimiento,
            'nivel_estudios'   => $request->madre_nivel_estudios,
            'vive_con_alumno'  => $request->has('madre_vive'),
            'es_tutor'         => $request->has('madre_es_tutor'),
            'es_finado'        => $request->has('madre_es_finado'),
            'tel_celular'      => $request->madre_tel_celular,
            'tel_fijo'         => $request->madre_tel_fijo,
            'email'            => $request->madre_email,
            'ocupacion'        => $request->madre_ocupacion,
        ]);

        // 4. Tutor (solo si es diferente al padre/madre)
        if ($request->has('tutor_diferente')) {
            $alumno->tutor()->create([
                'parentesco'       => $request->tutor_parentesco,
                'apellido_paterno' => $request->tutor_apellido_paterno,
                'apellido_materno' => $request->tutor_apellido_materno,
                'nombre'           => $request->tutor_nombre,
                'curp'             => $request->tutor_curp,
                'vive_con_alumno'  => $request->has('tutor_vive'),
                'es_tutor_legal'   => $request->has('tutor_legal'),
                'tel_celular'      => $request->tutor_tel_celular,
                'email'            => $request->tutor_email,
            ]);
        }

        // 5. Documento probatorio
        // 5. Documento probatorio (solo si tutor diferente)
if ($request->has('tutor_diferente')) {
    $alumno->documentoProbatorio()->create([
        'entidad_fed_registro' => $request->entidad_fed_registro,
        'municipio_registro'   => $request->municipio_registro,
        'año_registro'         => $request->año_registro,
        'tipo_documento'       => $request->tipo_documento,
        'num_libro'            => $request->num_libro,
        'num_acta'             => $request->num_acta,
        'crip'                 => $request->crip,
        'observaciones'        => $request->doc_observaciones,
    ]);
}

        // 6. Datos escuela
        $alumno->escuela()->create([
            'nombre_escuela' => $request->nombre_escuela,
            'cct'            => $request->cct,
            'turno'          => $request->turno,
            'grado'          => $request->grado,
            'grupo'          => $request->grupo,
            'ze'             => $request->ze,
        ]);

        // 7. Expediente
        $alumno->expediente()->create([
            'registrado_por' => auth()->id(),
            'estado'         => 'activo',
        ]);

        return redirect()->route('alumnos.index')
            ->with('success', 'Cédula registrada correctamente.');
    }

    public function show(Alumno $alumno)
    {
        $alumno->load('padre', 'madre', 'tutor', 'documentoProbatorio', 'escuela', 'expediente.validador');
        return view('alumnos.show', compact('alumno'));
    }

    public function edit(Alumno $alumno)
    {
        $alumno->load('padre', 'madre', 'tutor', 'documentoProbatorio', 'escuela');
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $fechaAlumno = $request->fecha_nacimiento;

        $request->validate([
            'ciclo_escolar'          => 'required|string',
            'fecha_cedula'           => 'required|date',
            'apellido_paterno'       => 'required|string|max:100',
            'apellido_materno'       => 'required|string|max:100',
            'nombre'                 => 'required|string|max:100',
            'curp'                   => 'required|string|size:18|unique:alumnos,curp,' . $alumno->id,
            'fecha_nacimiento'       => 'required|date|before:today',
            'entidad_nacimiento'     => 'required|string',
            'genero'                 => 'required|in:H,M',
            'padre_apellido_paterno' => 'required|string',
            'padre_nombre'           => 'required|string',
            'padre_fecha_nacimiento' => ['nullable', 'date', 'before:' . $fechaAlumno],
            'madre_apellido_paterno' => 'required|string',
            'madre_nombre'           => 'required|string',
            'madre_fecha_nacimiento' => ['nullable', 'date', 'before:' . $fechaAlumno],
            'tutor_fecha_nacimiento' => ['nullable', 'date', 'before:' . $fechaAlumno],
            'nombre_escuela'         => 'required|string',
            'grado'                  => 'required|string',
        ], [
            'padre_fecha_nacimiento.before' => 'La fecha de nacimiento del padre debe ser anterior a la del alumno.',
            'madre_fecha_nacimiento.before' => 'La fecha de nacimiento de la madre debe ser anterior a la del alumno.',
            'tutor_fecha_nacimiento.before' => 'La fecha de nacimiento del tutor debe ser anterior a la del alumno.',
            'fecha_nacimiento.before'       => 'La fecha de nacimiento del alumno no puede ser en el futuro.',
        ]);

        // 1. Alumno
        $alumno->update([
            'ciclo_escolar'      => $request->ciclo_escolar,
            'fecha_cedula'       => $request->fecha_cedula,
            'apellido_paterno'   => $request->apellido_paterno,
            'apellido_materno'   => $request->apellido_materno,
            'nombre'             => $request->nombre,
            'curp'               => strtoupper($request->curp),
            'fecha_nacimiento'   => $request->fecha_nacimiento,
            'pais_nacimiento'    => $request->pais_nacimiento ?? 'México',
            'entidad_nacimiento' => $request->entidad_nacimiento,
            'genero'             => $request->genero,
            'discapacidad'       => $request->discapacidad,
            'tipo_sangre'        => $request->tipo_sangre,
            'lengua_materna'     => $request->lengua_materna,
        ]);

        // 2. Padre
        $datosPadre = [
            'apellido_paterno' => $request->padre_apellido_paterno,
            'apellido_materno' => $request->padre_apellido_materno,
            'nombre'           => $request->padre_nombre,
            'curp'             => $request->padre_curp,
            'fecha_nacimiento' => $request->padre_fecha_nacimiento,
            'pais_nacimiento'  => $request->padre_pais_nacimiento,
            'nivel_estudios'   => $request->padre_nivel_estudios,
            'vive_con_alumno'  => $request->has('padre_vive'),
            'es_tutor'         => $request->has('padre_es_tutor'),
            'es_finado'        => $request->has('padre_es_finado'),
            'pais_residencia'  => $request->padre_pais_residencia,
            'entidad'          => $request->padre_entidad,
            'municipio'        => $request->padre_municipio,
            'localidad'        => $request->padre_localidad,
            'cp'               => $request->padre_cp,
            'colonia'          => $request->padre_colonia,
            'calle'            => $request->padre_calle,
            'num_ext'          => $request->padre_num_ext,
            'num_int'          => $request->padre_num_int,
            'tel_fijo'         => $request->padre_tel_fijo,
            'tel_celular'      => $request->padre_tel_celular,
            'email'            => $request->padre_email,
            'ocupacion'        => $request->padre_ocupacion,
            'horario'          => $request->padre_horario,
            'tel_trabajo'      => $request->padre_tel_trabajo,
            'ext_trabajo'      => $request->padre_ext_trabajo,
            'email_trabajo'    => $request->padre_email_trabajo,
        ];
        if ($alumno->padre) {
            $alumno->padre()->update($datosPadre);
        } else {
            $alumno->padre()->create(array_merge($datosPadre, ['tipo' => 'padre']));
        }

        // 3. Madre
        $datosMadre = [
            'apellido_paterno' => $request->madre_apellido_paterno,
            'apellido_materno' => $request->madre_apellido_materno,
            'nombre'           => $request->madre_nombre,
            'curp'             => $request->madre_curp,
            'fecha_nacimiento' => $request->madre_fecha_nacimiento,
            'pais_nacimiento'  => $request->madre_pais_nacimiento,
            'nivel_estudios'   => $request->madre_nivel_estudios,
            'vive_con_alumno'  => $request->has('madre_vive'),
            'es_tutor'         => $request->has('madre_es_tutor'),
            'es_finado'        => $request->has('madre_es_finado'),
            'pais_residencia'  => $request->madre_pais_residencia,
            'entidad'          => $request->madre_entidad,
            'municipio'        => $request->madre_municipio,
            'localidad'        => $request->madre_localidad,
            'cp'               => $request->madre_cp,
            'colonia'          => $request->madre_colonia,
            'calle'            => $request->madre_calle,
            'num_ext'          => $request->madre_num_ext,
            'num_int'          => $request->madre_num_int,
            'tel_fijo'         => $request->madre_tel_fijo,
            'tel_celular'      => $request->madre_tel_celular,
            'email'            => $request->madre_email,
            'ocupacion'        => $request->madre_ocupacion,
            'horario'          => $request->madre_horario,
            'tel_trabajo'      => $request->madre_tel_trabajo,
            'ext_trabajo'      => $request->madre_ext_trabajo,
            'email_trabajo'    => $request->madre_email_trabajo,
        ];
        if ($alumno->madre) {
            $alumno->madre()->update($datosMadre);
        } else {
            $alumno->madre()->create(array_merge($datosMadre, ['tipo' => 'madre']));
        }

        // 4. Tutor
        if ($request->has('tutor_diferente')) {
            $datosTutor = [
                'parentesco'       => $request->tutor_parentesco,
                'apellido_paterno' => $request->tutor_apellido_paterno,
                'apellido_materno' => $request->tutor_apellido_materno,
                'nombre'           => $request->tutor_nombre,
                'curp'             => $request->tutor_curp,
                'fecha_nacimiento' => $request->tutor_fecha_nacimiento,
                'pais_nacimiento'  => $request->tutor_pais_nacimiento,
                'nivel_estudios'   => $request->tutor_nivel_estudios,
                'vive_con_alumno'  => $request->tutor_vive_alumno == '1',
                'es_tutor_legal'   => $request->tutor_es_legal == '1',
                'pais_residencia'  => $request->tutor_pais_residencia,
                'entidad'          => $request->tutor_entidad,
                'municipio'        => $request->tutor_municipio,
                'localidad'        => $request->tutor_localidad,
                'cp'               => $request->tutor_cp,
                'colonia'          => $request->tutor_colonia,
                'calle'            => $request->tutor_calle,
                'num_ext'          => $request->tutor_num_ext,
                'num_int'          => $request->tutor_num_int,
                'tel_fijo'         => $request->tutor_tel_fijo,
                'tel_celular'      => $request->tutor_tel_celular,
                'email'            => $request->tutor_email,
                'ocupacion'        => $request->tutor_ocupacion,
                'horario'          => $request->tutor_horario,
                'tel_trabajo'      => $request->tutor_tel_trabajo,
                'ext_trabajo'      => $request->tutor_ext_trabajo,
                'email_trabajo'    => $request->tutor_email_trabajo,
            ];
            if ($alumno->tutor) {
                $alumno->tutor()->update($datosTutor);
            } else {
                $alumno->tutor()->create($datosTutor);
            }
        } else {
            // Si se desmarcó el checkbox, eliminar tutor si existía
            $alumno->tutor()->delete();
        }

        // 5. Documento probatorio
        $datosDoc = [
            'entidad_fed_registro' => $request->entidad_fed_registro,
            'municipio_registro'   => $request->municipio_registro,
            'año_registro'         => $request->año_registro,
            'tipo_documento'       => $request->tipo_documento,
            'num_libro'            => $request->num_libro,
            'num_acta'             => $request->num_acta,
            'crip'                 => $request->crip,
            'observaciones'        => $request->doc_observaciones,
        ];
        if ($alumno->documentoProbatorio) {
            $alumno->documentoProbatorio()->update($datosDoc);
        } else {
            $alumno->documentoProbatorio()->create($datosDoc);
        }

        // 6. Datos escuela
        $datosEscuela = [
            'nombre_escuela' => $request->nombre_escuela,
            'cct'            => $request->cct,
            'turno'          => $request->turno,
            'grado'          => $request->grado,
            'grupo'          => $request->grupo,
            'ze'             => $request->ze,
        ];
        if ($alumno->escuela) {
            $alumno->escuela()->update($datosEscuela);
        } else {
            $alumno->escuela()->create($datosEscuela);
        }

        return redirect()->route('alumnos.show', $alumno)
            ->with('success', 'Expediente actualizado correctamente.');
    }
    
    public function print(Alumno $alumno)
{
    $alumno->load('padre', 'madre', 'tutor', 'documentoProbatorio', 'escuela', 'expediente');
    return view('alumnos.print', compact('alumno'));
}
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno eliminado.');
    }
}