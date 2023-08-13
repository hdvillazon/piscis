<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$programas = Programa::orderBy('nombre')
		->with('matriculados')
		->get();

		$data = [
			'status' => 200,
			'programas' => $programas
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
		$programa = new Programa();
		$programa->nombre = $request->nombre;
		$programa->acronimo = $request->acronimo;
		$programa->estado = $request->estado;
		$programa->save();

		$data = [
			'status' => 201,
			'programa' => $programa
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Programa $programa)
	{
		$data = [
			'status' => 200,
			'programa' => $programa
		];

		return response()->json($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Programa $programa)
	{
		$data = [
			'status' => 200,
			'programa' => $programa
		];

		return response()->json($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Programa $programa)
	{
		$programa->nombre = $request->nombre;
		$programa->acronimo = $request->acronimo;
		$programa->estado = $request->estado;
		$programa->save();

		$data = [
			'status' => 200,
			'programa' => $programa
		];

		return response()->json($data);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Programa $programa)
	{
		try{
			$programa->delete();

			$data = [
				'status' => 200,
				'programa' => $programa
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

	public function cambiarEstado(Request $request, Programa $programa)
	{
		$programa->estado = $request->estado;
		$programa->save();

		$data = [
			'status' => 200,
			'programa' => $programa
		];

		return response()->json($data);
	}
}
