<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cédula de Registro - {{ $alumno->nombre_completo }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 7.5pt; color: #000; background: #fff; }
        @page { size: letter portrait; margin: 8mm 8mm 8mm 8mm; }
        @media print { .no-print { display: none !important; } }
        .no-print { position: fixed; top: 12px; right: 16px; z-index: 999; }
        .no-print button { background: #1d4ed8; color: #fff; border: none; padding: 8px 20px; border-radius: 6px; font-size: 13px; cursor: pointer; }
        .cedula { width: 195mm; margin: 0 auto; }
        .header-inst { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 3px; }
        .header-logos { display: flex; align-items: center; gap: 6px; }
        .logo-box { width: 36px; height: 36px; border: 1px solid #555; display: flex; align-items: center; justify-content: center; font-size: 5pt; font-weight: bold; color: #8B0000; text-align: center; line-height: 1.2; padding: 2px; }
        .logo-text { font-size: 8pt; font-weight: bold; line-height: 1.4; }
        .logo-text small { font-weight: normal; font-size: 6pt; display: block; }
        .header-right { font-size: 5.5pt; text-align: right; line-height: 1.5; }
        .header-right strong { font-size: 6pt; }
        .titulo { text-align: center; font-size: 10.5pt; font-weight: bold; text-transform: uppercase; border-top: 1px solid #000; padding-top: 3px; margin: 3px 0; letter-spacing: 0.4px; }
        .fila-top { display: flex; gap: 16px; font-size: 7pt; margin-bottom: 3px; padding-left: 2px; }
        .fila-top span { border-bottom: 1px solid #000; min-width: 45mm; display: inline-block; padding-bottom: 1px; margin-left: 3px; }
        .seccion { border: 1px solid #000; margin-bottom: 3px; }
        .sec-header { background: #8B0000; color: #fff; font-weight: bold; font-size: 7.5pt; text-transform: uppercase; padding: 2px 6px; }
        .sec-body { padding: 3px 5px 4px; }
        .fila { display: flex; align-items: flex-end; gap: 4px; margin-bottom: 4px; }
        .campo { display: flex; flex-direction: column; }
        .campo label { font-size: 5.5pt; text-transform: uppercase; margin-bottom: 1px; white-space: nowrap; }
        .campo .v { border-bottom: 1px solid #000; min-height: 10px; font-size: 7.5pt; padding-bottom: 1px; white-space: nowrap; overflow: hidden; }
        .f1 { flex: 1; }
        .w15 { width: 15mm; } .w20 { width: 20mm; } .w25 { width: 25mm; } .w30 { width: 30mm; }
        .w35 { width: 35mm; } .w40 { width: 40mm; } .w45 { width: 45mm; } .w50 { width: 50mm; }
        .w55 { width: 55mm; } .w60 { width: 60mm; } .w70 { width: 70mm; } .w80 { width: 80mm; }
        .w90 { width: 90mm; }
        .nia-fila { display: flex; justify-content: flex-end; gap: 4px; align-items: baseline; margin-bottom: 2px; font-size: 7pt; }
        .nia-fila .v { border-bottom: 1px solid #000; min-width: 40mm; font-size: 7.5pt; }
        .fila3 { display: flex; gap: 3px; margin-bottom: 4px; }
        .fila3 .campo { flex: 1; }
        .chk { display: inline-block; width: 9px; height: 9px; border: 1px solid #000; position: relative; vertical-align: middle; }
        .chk.on::after { content: 'X'; position: absolute; top: -1px; left: 1px; font-size: 7pt; font-weight: bold; }
        .chk-label { font-size: 7.5pt; vertical-align: middle; }
        .sub { font-weight: bold; font-size: 7.5pt; margin: 3px 0 2px; }
        .doc-grid { display: flex; gap: 3px; margin-top: 3px; }
        .doc-col { border: 1px solid #777; padding: 3px; flex: 1; font-size: 6.5pt; }
        .doc-col-header { font-weight: bold; font-size: 6.5pt; display: flex; align-items: center; gap: 4px; margin-bottom: 3px; }
        .doc-col .campo { margin-bottom: 3px; }
        .doc-col label { font-size: 5.5pt; }
        .firmas { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 10mm; gap: 8mm; }
        .firma-bloque { flex: 1; text-align: center; }
        .firma-linea { border-bottom: 1px solid #000; min-height: 18mm; margin-bottom: 2px; }
        .firma-etiq { font-size: 6.5pt; font-weight: bold; text-transform: uppercase; line-height: 1.4; }
        .sello-bloque { flex: 0.8; text-align: center; }
        .sello-box { border: 1px solid #000; min-height: 20mm; margin-bottom: 2px; }
        .sello-etiq { font-size: 6.5pt; font-weight: bold; text-transform: uppercase; }
        .nota-legal { font-size: 4.8pt; color: #222; text-align: justify; margin-top: 4px; line-height: 1.3; }
        .page-break { page-break-before: always; padding-top: 4mm; }
    </style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print()">🖨️ Imprimir Cédula</button>
</div>

<div class="cedula">

    <div class="header-inst">
        <div class="header-logos">
            <div class="logo-box">PUEBLA<br>Educación</div>
            <div class="logo-text">
                PUEBLA <strong>Educación</strong>
                <small>Gobierno del Estado</small>
                <small>Secretaría de Educación Pública</small>
            </div>
        </div>
        <div class="header-right">
            <strong>DIRECCIÓN GENERAL DE PLANEACIÓN Y DEL SISTEMA PARA<br>
            LA CARRERA DE LAS MAESTRAS Y DE LOS MAESTROS</strong><br>
            DIRECCIÓN DE CONTROL ESCOLAR
        </div>
    </div>

    <div class="titulo">Cédula de Registro y Actualización de Datos</div>

    <div class="fila-top">
        <span style="border:none">CICLO ESCOLAR:</span><span>{{ $alumno->ciclo_escolar }}</span>
        &nbsp;&nbsp;&nbsp;
        <span style="border:none">FECHA:</span><span>{{ \Carbon\Carbon::parse($alumno->fecha_cedula)->format('d/m/Y') }}</span>
    </div>

    {{-- DATOS GENERALES DEL ALUMNO --}}
    <div class="seccion">
        <div class="sec-header">Datos Generales del Alumno(a)</div>
        <div class="sec-body">
            <div class="nia-fila"><span>NIA:</span><span class="v">{{ $alumno->nia }}</span></div>
            <div class="fila3">
                <div class="campo"><label>Apellido Paterno</label><div class="v">{{ $alumno->apellido_paterno }}</div></div>
                <div class="campo"><label>Apellido Materno</label><div class="v">{{ $alumno->apellido_materno }}</div></div>
                <div class="campo"><label>Nombre(s)</label><div class="v">{{ $alumno->nombre }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w90"><label>CURP</label><div class="v" style="font-family:monospace">{{ $alumno->curp }}</div></div>
                <div class="campo w50"><label>Fecha de Nacimiento (día/mes/año)</label><div class="v">{{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d/m/Y') }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w60"><label>País de Nacimiento</label><div class="v">{{ $alumno->pais_nacimiento ?? 'México' }}</div></div>
                <div class="campo f1"><label>Entidad de Nacimiento</label><div class="v">{{ $alumno->entidad_nacimiento }}</div></div>
            </div>
            <div class="fila" style="align-items:center; gap:6px;">
                <span style="font-size:5.5pt;text-transform:uppercase">GÉNERO:</span>
                <span class="chk {{ $alumno->genero == 'H' ? 'on' : '' }}"></span><span class="chk-label">H</span>
                <span class="chk {{ $alumno->genero == 'M' ? 'on' : '' }}"></span><span class="chk-label">M</span>
                <div class="campo f1" style="margin-left:6px"><label>Discapacidad / Aptitud Diferenciada</label><div class="v">{{ $alumno->discapacidad ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w40"><label>Tipo de Sangre</label><div class="v">{{ $alumno->tipo_sangre ?? '' }}</div></div>
                <div class="campo f1"><label>Lengua Materna</label><div class="v">{{ $alumno->lengua_materna ?? '' }}</div></div>
            </div>
        </div>
    </div>

    {{-- DATOS DEL PADRE --}}
    <div class="seccion">
        <div class="sec-header">Datos del Padre</div>
        <div class="sec-body">
            @php $padre = $alumno->padre; @endphp
            <div class="fila3">
                <div class="campo"><label>Apellido Paterno</label><div class="v">{{ $padre->apellido_paterno ?? '' }}</div></div>
                <div class="campo"><label>Apellido Materno</label><div class="v">{{ $padre->apellido_materno ?? '' }}</div></div>
                <div class="campo"><label>Nombre(s)</label><div class="v">{{ $padre->nombre ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w90"><label>CURP</label><div class="v" style="font-family:monospace">{{ $padre->curp ?? '' }}</div></div>
                <div class="campo w50"><label>Fecha de Nacimiento (día/mes/año)</label><div class="v">{{ $padre->fecha_nacimiento ? \Carbon\Carbon::parse($padre->fecha_nacimiento)->format('d/m/Y') : '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w60"><label>País de Nacimiento</label><div class="v">{{ $padre->pais_nacimiento ?? '' }}</div></div>
                <div class="campo f1"><label>Nivel de Estudios</label><div class="v">{{ $padre->nivel_estudios ?? '' }}</div></div>
            </div>
            <div class="fila" style="align-items:center; gap:8px;">
                <span style="font-size:5.5pt;text-transform:uppercase">Vive con el alumno:</span>
                <span class="chk {{ $padre && $padre->vive_con_alumno ? 'on' : '' }}"></span><span class="chk-label">Sí</span>
                <span class="chk {{ $padre && !$padre->vive_con_alumno ? 'on' : '' }}"></span><span class="chk-label">No</span>
                &nbsp;&nbsp;
                <span style="font-size:5.5pt;text-transform:uppercase">Es el Tutor:</span>
                <span class="chk {{ $padre && $padre->es_tutor ? 'on' : '' }}"></span>
                &nbsp;&nbsp;
                <span style="font-size:5.5pt;text-transform:uppercase">Es Finado:</span>
                <span class="chk {{ $padre && $padre->es_finado ? 'on' : '' }}"></span>
            </div>
            <div class="sub">Dirección</div>
            <div class="fila">
                <div class="campo w60"><label>País de Residencia</label><div class="v">{{ $padre->pais_residencia ?? '' }}</div></div>
                <div class="campo f1"><label>Entidad</label><div class="v">{{ $padre->entidad ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w60"><label>Municipio</label><div class="v">{{ $padre->municipio ?? '' }}</div></div>
                <div class="campo f1"><label>Localidad</label><div class="v">{{ $padre->localidad ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w25"><label>CP</label><div class="v">{{ $padre->cp ?? '' }}</div></div>
                <div class="campo f1"><label>Colonia</label><div class="v">{{ $padre->colonia ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w80"><label>Calle</label><div class="v">{{ $padre->calle ?? '' }}</div></div>
                <div class="campo w20"><label>Núm. Ext.</label><div class="v">{{ $padre->num_ext ?? '' }}</div></div>
                <div class="campo w20"><label>Núm. Int.</label><div class="v">{{ $padre->num_int ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w35"><label>Tel. Fijo</label><div class="v">{{ $padre->tel_fijo ?? '' }}</div></div>
                <div class="campo w35"><label>Tel. Celular</label><div class="v">{{ $padre->tel_celular ?? '' }}</div></div>
                <div class="campo f1"><label>E-mail</label><div class="v">{{ $padre->email ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w70"><label>Ocupación</label><div class="v">{{ $padre->ocupacion ?? '' }}</div></div>
                <div class="campo f1"><label>Horario</label><div class="v">{{ $padre->horario ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w40"><label>Tel. Trabajo</label><div class="v">{{ $padre->tel_trabajo ?? '' }}</div></div>
                <div class="campo w20"><label>Ext.</label><div class="v">{{ $padre->ext_trabajo ?? '' }}</div></div>
                <div class="campo f1"><label>E-mail Trabajo</label><div class="v">{{ $padre->email_trabajo ?? '' }}</div></div>
            </div>
        </div>
    </div>

    {{-- DATOS DE LA MADRE --}}
    <div class="seccion">
        <div class="sec-header">Datos de la Madre</div>
        <div class="sec-body">
            @php $madre = $alumno->madre; @endphp
            <div class="fila3">
                <div class="campo"><label>Apellido Paterno</label><div class="v">{{ $madre->apellido_paterno ?? '' }}</div></div>
                <div class="campo"><label>Apellido Materno</label><div class="v">{{ $madre->apellido_materno ?? '' }}</div></div>
                <div class="campo"><label>Nombre(s)</label><div class="v">{{ $madre->nombre ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w90"><label>CURP</label><div class="v" style="font-family:monospace">{{ $madre->curp ?? '' }}</div></div>
                <div class="campo w50"><label>Fecha de Nacimiento (día/mes/año)</label><div class="v">{{ $madre->fecha_nacimiento ? \Carbon\Carbon::parse($madre->fecha_nacimiento)->format('d/m/Y') : '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w60"><label>País de Nacimiento</label><div class="v">{{ $madre->pais_nacimiento ?? '' }}</div></div>
                <div class="campo f1"><label>Nivel de Estudios</label><div class="v">{{ $madre->nivel_estudios ?? '' }}</div></div>
            </div>
            <div class="fila" style="align-items:center; gap:8px;">
                <span style="font-size:5.5pt;text-transform:uppercase">Vive con el alumno:</span>
                <span class="chk {{ $madre && $madre->vive_con_alumno ? 'on' : '' }}"></span><span class="chk-label">Sí</span>
                <span class="chk {{ $madre && !$madre->vive_con_alumno ? 'on' : '' }}"></span><span class="chk-label">No</span>
                &nbsp;&nbsp;
                <span style="font-size:5.5pt;text-transform:uppercase">Es el Tutor:</span>
                <span class="chk {{ $madre && $madre->es_tutor ? 'on' : '' }}"></span>
                &nbsp;&nbsp;
                <span style="font-size:5.5pt;text-transform:uppercase">Es Finada:</span>
                <span class="chk {{ $madre && $madre->es_finado ? 'on' : '' }}"></span>
            </div>
            <div class="sub">Dirección</div>
            <div class="fila">
                <div class="campo w60"><label>País de Residencia</label><div class="v">{{ $madre->pais_residencia ?? '' }}</div></div>
                <div class="campo f1"><label>Entidad</label><div class="v">{{ $madre->entidad ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w60"><label>Municipio</label><div class="v">{{ $madre->municipio ?? '' }}</div></div>
                <div class="campo f1"><label>Localidad</label><div class="v">{{ $madre->localidad ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w25"><label>CP</label><div class="v">{{ $madre->cp ?? '' }}</div></div>
                <div class="campo f1"><label>Colonia</label><div class="v">{{ $madre->colonia ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w80"><label>Calle</label><div class="v">{{ $madre->calle ?? '' }}</div></div>
                <div class="campo w20"><label>Núm. Ext.</label><div class="v">{{ $madre->num_ext ?? '' }}</div></div>
                <div class="campo w20"><label>Núm. Int.</label><div class="v">{{ $madre->num_int ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w35"><label>Tel. Fijo</label><div class="v">{{ $madre->tel_fijo ?? '' }}</div></div>
                <div class="campo w35"><label>Tel. Celular</label><div class="v">{{ $madre->tel_celular ?? '' }}</div></div>
                <div class="campo f1"><label>E-mail</label><div class="v">{{ $madre->email ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w70"><label>Ocupación</label><div class="v">{{ $madre->ocupacion ?? '' }}</div></div>
                <div class="campo f1"><label>Horario</label><div class="v">{{ $madre->horario ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w40"><label>Tel. Trabajo</label><div class="v">{{ $madre->tel_trabajo ?? '' }}</div></div>
                <div class="campo w20"><label>Ext.</label><div class="v">{{ $madre->ext_trabajo ?? '' }}</div></div>
                <div class="campo f1"><label>E-mail Trabajo</label><div class="v">{{ $madre->email_trabajo ?? '' }}</div></div>
            </div>
        </div>
    </div>

</div>{{-- fin página 1 --}}


{{-- ===== PÁGINA 2 ===== --}}
<div class="cedula page-break">

    {{-- DATOS DEL TUTOR --}}
    @php $tutor = $alumno->tutor; @endphp
    <div class="seccion">
        <div class="sec-header">Datos del Tutor &nbsp;<small style="font-weight:normal;font-size:6pt">* Llenar en caso de que el tutor sea diferente al padre o madre del alumno.</small></div>
        <div class="sec-body">
            <div class="fila">
                <div class="campo f1"><label>Parentesco</label><div class="v">{{ $tutor->parentesco ?? '' }}</div></div>
            </div>
            <div class="fila3">
                <div class="campo"><label>Apellido Paterno</label><div class="v">{{ $tutor->apellido_paterno ?? '' }}</div></div>
                <div class="campo"><label>Apellido Materno</label><div class="v">{{ $tutor->apellido_materno ?? '' }}</div></div>
                <div class="campo"><label>Nombre(s)</label><div class="v">{{ $tutor->nombre ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w90"><label>CURP</label><div class="v" style="font-family:monospace">{{ $tutor->curp ?? '' }}</div></div>
                <div class="campo w50"><label>Fecha de Nacimiento (día/mes/año)</label><div class="v">{{ ($tutor && $tutor->fecha_nacimiento) ? \Carbon\Carbon::parse($tutor->fecha_nacimiento)->format('d/m/Y') : '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w60"><label>País de Nacimiento</label><div class="v">{{ $tutor->pais_nacimiento ?? '' }}</div></div>
                <div class="campo f1"><label>Nivel de Estudios</label><div class="v">{{ $tutor->nivel_estudios ?? '' }}</div></div>
            </div>
            <div class="fila" style="align-items:center; gap:8px;">
                <span style="font-size:5.5pt;text-transform:uppercase">Vive con el alumno:</span>
                <span class="chk {{ $tutor && $tutor->vive_con_alumno ? 'on' : '' }}"></span><span class="chk-label">Sí</span>
                <span class="chk {{ $tutor && !$tutor->vive_con_alumno ? 'on' : '' }}"></span><span class="chk-label">No</span>
                &nbsp;&nbsp;
                <span style="font-size:5.5pt;text-transform:uppercase">¿Es Tutor Legal?:</span>
                <span class="chk {{ $tutor && $tutor->es_tutor_legal ? 'on' : '' }}"></span><span class="chk-label">Sí</span>
                <span class="chk {{ $tutor && !$tutor->es_tutor_legal ? 'on' : '' }}"></span><span class="chk-label">No</span>
            </div>
            <div class="sub">Dirección</div>
            <div class="fila">
                <div class="campo w60"><label>País de Residencia</label><div class="v">{{ $tutor->pais_residencia ?? '' }}</div></div>
                <div class="campo f1"><label>Entidad</label><div class="v">{{ $tutor->entidad ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w60"><label>Municipio</label><div class="v">{{ $tutor->municipio ?? '' }}</div></div>
                <div class="campo f1"><label>Localidad</label><div class="v">{{ $tutor->localidad ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w25"><label>CP</label><div class="v">{{ $tutor->cp ?? '' }}</div></div>
                <div class="campo f1"><label>Colonia</label><div class="v">{{ $tutor->colonia ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w80"><label>Calle</label><div class="v">{{ $tutor->calle ?? '' }}</div></div>
                <div class="campo w20"><label>Núm. Ext.</label><div class="v">{{ $tutor->num_ext ?? '' }}</div></div>
                <div class="campo w20"><label>Núm. Int.</label><div class="v">{{ $tutor->num_int ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w35"><label>Tel. Fijo</label><div class="v">{{ $tutor->tel_fijo ?? '' }}</div></div>
                <div class="campo w35"><label>Tel. Celular</label><div class="v">{{ $tutor->tel_celular ?? '' }}</div></div>
                <div class="campo f1"><label>E-mail</label><div class="v">{{ $tutor->email ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w70"><label>Ocupación</label><div class="v">{{ $tutor->ocupacion ?? '' }}</div></div>
                <div class="campo f1"><label>Horario</label><div class="v">{{ $tutor->horario ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w40"><label>Tel. Trabajo</label><div class="v">{{ $tutor->tel_trabajo ?? '' }}</div></div>
                <div class="campo w20"><label>Ext.</label><div class="v">{{ $tutor->ext_trabajo ?? '' }}</div></div>
                <div class="campo f1"><label>E-mail Trabajo</label><div class="v">{{ $tutor->email_trabajo ?? '' }}</div></div>
            </div>
        </div>
    </div>

    {{-- DOCUMENTO PROBATORIO --}}
    @php $doc = $alumno->documentoProbatorio; @endphp
    <div class="seccion">
        <div class="sec-header">Documento Probatorio</div>
        <div class="sec-body">
            <div class="fila">
                <div class="campo f1"><label>Entidad Fed. Registro</label><div class="v">{{ $doc->entidad_fed_registro ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w80"><label>Municipio de Registro</label><div class="v">{{ $doc->municipio_registro ?? '' }}</div></div>
                <div class="campo w30"><label>Año Registro</label><div class="v">{{ $doc->año_registro ?? '' }}</div></div>
            </div>
            <div class="doc-grid">
                <div class="doc-col">
                    <div class="doc-col-header">
                        <span class="chk {{ ($doc && $doc->tipo_documento == 'acta') ? 'on' : '' }}"></span> Acta de Nacimiento
                    </div>
                    <div class="campo"><label>No. de Libro</label><div class="v">{{ ($doc && $doc->tipo_documento == 'acta') ? ($doc->num_libro ?? '') : '' }}</div></div>
                    <div class="campo"><label>No. de Acta</label><div class="v">{{ ($doc && $doc->tipo_documento == 'acta') ? ($doc->num_acta ?? '') : '' }}</div></div>
                    <div class="campo"><label>CRIP</label><div class="v">{{ ($doc && $doc->tipo_documento == 'acta') ? ($doc->crip ?? '') : '' }}</div></div>
                </div>
                <div class="doc-col">
                    <div class="doc-col-header">
                        <span class="chk {{ ($doc && $doc->tipo_documento == 'migratorio') ? 'on' : '' }}"></span> Documento Migratorio
                    </div>
                    <div class="campo"><label>No. Registro Nacional de Extranjeros</label><div class="v">{{ ($doc && $doc->tipo_documento == 'migratorio') ? ($doc->num_registro_nacional_extranjeros ?? '') : '' }}</div></div>
                </div>
                <div class="doc-col">
                    <div class="doc-col-header">
                        <span class="chk {{ ($doc && $doc->tipo_documento == 'sre') ? 'on' : '' }}"></span> Documento de Naturalización SRE
                    </div>
                    <div class="campo"><label>Folio de la Carta</label><div class="v">{{ ($doc && $doc->tipo_documento == 'sre') ? ($doc->folio_carta ?? '') : '' }}</div></div>
                </div>
                <div class="doc-col">
                    <div class="doc-col-header">
                        <span class="chk {{ ($doc && $doc->tipo_documento == 'ficha') ? 'on' : '' }}"></span> Ficha Signalética
                    </div>
                    <div class="campo"><label>No. Juzgado</label><div class="v">{{ ($doc && $doc->tipo_documento == 'ficha') ? ($doc->num_juzgado ?? '') : '' }}</div></div>
                    <div class="campo"><label>Folio de la Ficha</label><div class="v">{{ ($doc && $doc->tipo_documento == 'ficha') ? ($doc->folio_ficha ?? '') : '' }}</div></div>
                </div>
            </div>
            <div class="fila" style="margin-top:4px; align-items:center; gap:6px;">
                <span class="chk {{ ($doc && !$doc->tipo_documento) ? 'on' : '' }}"></span>
                <span style="font-size:7pt">No entregó documento probatorio</span>
            </div>
            <div class="fila" style="margin-top:3px;">
                <div class="campo f1"><label>Observaciones</label><div class="v">{{ $doc->observaciones ?? '' }}</div></div>
            </div>
        </div>
    </div>

    {{-- DATOS DE LA ESCUELA --}}
    @php $escuela = $alumno->escuela; @endphp
    <div class="seccion">
        <div class="sec-header">Datos de la Escuela</div>
        <div class="sec-body">
            <div class="fila">
                <div class="campo f1"><label>Nombre Escuela</label><div class="v">{{ $escuela->nombre_escuela ?? '' }}</div></div>
            </div>
            <div class="fila">
                <div class="campo w50"><label>CCT</label><div class="v">{{ $escuela->cct ?? '' }}</div></div>
                <div class="campo w30"><label>Turno</label><div class="v">{{ $escuela->turno ?? '' }}</div></div>
                <div class="campo w20"><label>Grado</label><div class="v">{{ $escuela->grado ?? '' }}</div></div>
                <div class="campo w20"><label>Grupo</label><div class="v">{{ $escuela->grupo ?? '' }}</div></div>
                <div class="campo w20"><label>ZE</label><div class="v">{{ $escuela->ze ?? '' }}</div></div>
            </div>
        </div>
    </div>

    {{-- FIRMAS --}}
    <div class="firmas">
        <div class="firma-bloque">
            <div class="firma-linea"></div>
            <div class="firma-etiq">Nombre y Firma<br>del Padre o Tutor</div>
        </div>
        <div class="sello-bloque">
            <div class="sello-box"></div>
            <div class="sello-etiq">Sello</div>
        </div>
        <div class="firma-bloque">
            <div class="firma-linea"></div>
            <div class="firma-etiq">Nombre y Firma<br>del Director</div>
        </div>
    </div>

    {{-- NOTA LEGAL --}}
    <div class="nota-legal">
        La Secretaría de Educación Pública, tratará los datos personales antes señalados con fundamento en lo dispuesto en: Los Artículo 44 fracción I, II, III, IX y XII del reglamento interior de la Secretaría de Educación Pública (Periódico Oficial del Estado 31 de agosto de 2018); normas específicas de control escolar relativas a la inscripción, reinscripción, acreditación, promoción, regularización y certificación en la educación básica vigentes; manual de normas de control escolar para los bachilleratos estatales escolarizados oficiales y particulares con reconocimiento de validez oficial de estudios (RVOE) vigentes; así como los demás aplicables de la Ley de Protección de Datos Personales en posesión de Sujetos Obligados del Estado de Puebla.
    </div>

</div>{{-- fin página 2 --}}

</body>
</html>