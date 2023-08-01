<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use App\Models\Proyecto;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProyectoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$proyectos = Proyecto::orderBy('nombre')
		->with('tutores')
		->with('estudiantes')
		->with('lineas')
		->get();

		$data = [
			'status' => 200,
			'proyectos' => $proyectos
		];

		return response()->json($data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$lineas = Linea::orderBy('nombre')
		->with('grupos')
		->get();

		$tutores = Tutor::orderBy('nombres')
		->orderBy('apellidos')
		->get();

		$data = [
			'status' => 200,
			'lineas' => $lineas,
			'tutores' => $tutores
		];

		return response()->json($data);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$proyecto = new Proyecto();
		$proyecto->nombre = $request->nombre;
		$proyecto->estado = $request->estado;
		$proyecto->descripcion = $request->descripcion;
		$proyecto->save();

		$data = [
			'status' => 201,
			'proyecto' => $proyecto
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Proyecto $proyecto)
	{
		$proyecto = $proyecto->with('tutores')
		->with('estudiantes')
		->with('lineas')
		->first();
		
		$data = [
			'status' => 200,
			'proyecto' => $proyecto
		];

		return response()->json($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Proyecto $proyecto)
	{
		$data = [
			'status' => 200,
			'proyecto' => $proyecto
		];

		return response()->json($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Proyecto $proyecto)
	{
		$proyecto->nombre = $request->nombre;
		$proyecto->estado = $request->estado;
		$proyecto->descripcion = $request->descripcion;
		$proyecto->save();

		$data = [
			'status' => 200,
			'proyecto' => $proyecto
		];

		return response()->json($data);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Proyecto $proyecto)
	{
		try{
			$proyecto->delete();

			$data = [
				'status' => 200,
				'proyecto' => $proyecto
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
}
