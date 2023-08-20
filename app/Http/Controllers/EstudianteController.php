<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Semestre;
use App\Models\Programa;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$estudiantes = Estudiante::orderBy('apellidos')
        ->orderBy('nombres')
        ->with('actividades')
        ->with('categorias_certificacion')
        ->with('programas')
        ->with('semestres')
        ->get();

        $data = [
			'status' => 200,
			'estudiantes' => $estudiantes
		];

		return response()->json($data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$programas = Programa::orderBy('nombre')
		->get();

		$semestres = Semestre::orderBy('numero')
		->where('estado', 1)
		->get();

		$tipo_documentos = TipoDocumento::orderBy('nombre_largo')
		->get();

		$data = [
			'semestres' => $semestres,
			'programas' => $programas,
			'tipo_documentos' => $tipo_documentos
		];

		return response()->json($data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$estudiante = new Estudiante();
		$estudiante->nombres = $request->nombres;
		$estudiante->apellidos = $request->apellidos;
		$estudiante->documento = $request->documento;
		$estudiante->codigo_est = $request->codigo_est;
		$estudiante->anio_vinculacion = $request->anio_vinculacion;
		$estudiante->periodo_vinculacion = $request->periodo_vinculacion;
		$estudiante->activo_semillero = $request->activo_semillero;
		$estudiante->correo_institucional = $request->correo_institucional;
		$estudiante->correo_personal = $request->correo_personal;
		$estudiante->telefono = $request->telefono;
		$estudiante->observaciones = $request->observaciones;
		$estudiante->convocatoria_joven_inv = $request->convocatoria_joven_inv;
		$estudiante->semestre_id = $request->semestre_id;
		$estudiante->programa_id = $request->programa_id;
		$estudiante->tipo_documento_id = $request->tipo_documento_id;
		$estudiante->en_minor = $request->en_minor;
		$estudiante->save();

		$data = [
			'status' => 201,
			'estudiante' => $estudiante
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Estudiante $estudiante)
	{
        $data = [
			'status' => 200,
			'actividad' => $estudiante
		];

		return response()->json($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Estudiante $estudiante)
	{

	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Estudiante $estudiante)
	{
		$estudiante->nombres = $request->nombres;
		$estudiante->apellidos = $request->apellidos;
		$estudiante->documento = $request->documento;
		$estudiante->codigo_est = $request->codigo_est;
		$estudiante->anio_vinculacion = $request->anio_vinculacion;
		$estudiante->periodo_vinculacion = $request->periodo_vinculacion;
		$estudiante->activo_semillero = $request->activo_semillero;
		$estudiante->correo_institucional = $request->correo_institucional;
		$estudiante->correo_personal = $request->correo_personal;
		$estudiante->telefono = $request->telefono;
		$estudiante->observaciones = $request->observaciones;
		$estudiante->convocatoria_joven_inv = $request->convocatoria_joven_inv;
		$estudiante->semestre_id = $request->semestre_id;
		$estudiante->programa_id = $request->programa_id;
		$estudiante->tipo_documento_id = $request->tipo_documento_id;
		$estudiante->en_minor = $request->en_minor;
		$estudiante->save();

		$data = [
			'status' => 200,
			'estudiante' => $estudiante
		];

		return response()->json($data);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Estudiante $estudiante)
	{
		//
	}
}
