<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$actividades = Actividad::orderBy('nombre')
		->get();

		$data = [
			'status' => 200,
			'actividades' => $actividades
		];

		return response()->json($data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$actividad = new Actividad();
		$actividad->nombre = $request->nombre;
		$actividad->puntos = $request->puntos;
		$actividad->estado = $request->estado;
		$actividad->descripcion = $request->descripcion;
		$actividad->save();

		$data = [
			'status' => 201,
			'actividad' => $actividad
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Actividad $actividad)
	{
		$data = [
			'status' => 200,
			'actividad' => $actividad
		];

		return response()->json($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Actividad $actividad)
	{
		$data = [
			'status' => 200,
			'actividad' => $actividad
		];

		return response()->json($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Actividad $actividad)
	{
		$actividad->nombre = $request->nombre;
		$actividad->puntos = $request->puntos;
		$actividad->estado = $request->estado;
		$actividad->descripcion = $request->descripcion;
		$actividad->save();

		$data = [
			'status' => 200,
			'actividad' => $actividad
		];

		return response()->json($data);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Actividad $actividad)
	{
		try{
			$actividad->delete();

			$data = [
				'status' => 200,
				'actividad' => $actividad
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

	public function desactivar(Actividad $actividad)
	{
		$actividad->estado = 0;
		$actividad->save();

		$data = [
			'status' => 200,
			'actividad' => $actividad
		];

		return response()->json($data);
	}
}
