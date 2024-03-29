<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Programa;
use App\Models\TipoDocumento;
use App\Models\Tutor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TutorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tutores = Tutor::orderBy('nombres')
		->orderBy('apellidos')
		->with(['grupo', 'lineas', 'programa', 'tipoDocumento'])
		->withCount('lineas as total_lineas', 'proyectos as total_proyectos')
		->get();
		
		$data = [
			'status' => 200,
			'tutores' => $tutores
		];

		return response()->json($data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$grupos = Grupo::orderBy('nombre')
		->get();

		$programas = Programa::orderBy('nombre')
		->get();

		$tiposDocumento = TipoDocumento::orderBy('nombre_largo')
		->get();

		$data = [
			'status' => 200,
			'grupos' => $grupos,
			'programas' => $programas,
			'tiposDocumento' => $tiposDocumento
		];

		return response()->json($data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$tutor = new Tutor();
		$tutor->nombres = $request->nombres;
		$tutor->apellidos = $request->apellidos;
		$tutor->descripcion = $request->descripcion;
		$tutor->correo_institucional = $request->correo_institucional;
		$tutor->programa_id = $request->programa_id;
		$tutor->grupo_id = $request->grupo_id;
		$tutor->documento = $request->documento;
		$tutor->estado = $request->estado;
		$tutor->tipo_documento_id = $request->tipo_documento_id;
		$tutor->save();

		$tutor->lineas()->attach($request->lineas);

		$tutor->load(['grupo', 'lineas', 'programa', 'tipoDocumento'])
		->loadCount('lineas as total_lineas', 'proyectos as total_proyectos');

		$data = [
			'status' => 201,
			'tutor' => $tutor
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Tutor $tutor)
	{
		$tutor = $tutor->load(['estudiantesSinProyecto.programa', 'proyectos.estudiantes.programa', 'programa']);

		$data = [
			'status' => 200,
			'tutor' => $tutor
		];

		return response()->json($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Tutor $tutor)
	{
		$data = [
			'status' => 200,
			'tutor' => $tutor
		];

		return response()->json($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Tutor $tutor)
	{
		$tutor->nombres = $request->nombres;
		$tutor->apellidos = $request->apellidos;
		$tutor->descripcion = $request->descripcion;
		$tutor->correo_institucional = $request->correo_institucional;
		$tutor->programa_id = $request->programa_id;
		$tutor->grupo_id = $request->grupo_id;
		$tutor->documento = $request->documento;
		$tutor->estado = $request->estado;
		$tutor->tipo_documento_id = $request->tipo_documento_id;
		$tutor->save();

		$tutor->lineas()->sync($request->lineas);

		$data = [
			'status' => 200,
			'tutor' => $tutor
		];

		return response()->json($data);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Tutor $tutor)
	{
		try{
			$tutor->delete();

			$data = [
				'status' => 200,
				'tutor' => $tutor
			];
		}catch(QueryException $ex){
			$codigoError = $ex->errorInfo[1];

			if($codigoError == 1451){
				$data = [
					'status' => 500,
					'mensaje' => 'El registro no pudo ser eliminado, ya que tiene relación con otros registros'
				];
			}
		}

		return response()->json($data);
	}

	public function cambiarEstado(Request $request, Tutor $tutor)
	{
		// Obtener el estado actual
		$estadoActual = $tutor->estado;

		// Cambiar el estado de 0 a 1 o de 1 a 0
		$nuevoEstado = ($estadoActual == 0) ? 1 : 0;

		$tutor->estado = $nuevoEstado;
		$tutor->save();

		$data = [
			'status' => 200,
			'tutor' => $tutor
		];

		return response()->json($data);
	}

	public function asignarEstudiante(Request $request, Tutor $tutor)
	{
		$tutor->estudiantes()->sync($request->estudiantes);

		$tutor->load(['estudiantesSinProyecto.programa', 'proyectos.estudiantes.programa', 'programa']);

		$data = [
			'status' => 200,
			'tutor' => $tutor
		];

		return response()->json($data);
	}
}
