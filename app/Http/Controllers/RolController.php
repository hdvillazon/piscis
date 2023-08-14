<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RolController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$roles = Rol::orderBy('nombre_largo')
		->get();

		$data = [
			'status' => 200,
			'roles' => $roles
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
		$rol = new Rol();
		$rol->nombre_corto = $request->nombre_corto;
		$rol->nombre_largo = $request->nombre_largo;
		$rol->estado = $request->estado;
		$rol->save();

		$data = [
			'status' => 201,
			'rol' => $rol
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Rol $rol)
	{
		$data = [
			'status' => 200,
			'rol' => $rol
		];

		return response()->json($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Rol $rol)
	{
		$data = [
			'status' => 200,
			'rol' => $rol
		];

		return response()->json($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Rol $rol)
	{
		$rol->nombre_corto = $request->nombre_corto;
		$rol->nombre_largo = $request->nombre_largo;
		$rol->estado = $request->estado;
		$rol->save();

		$data = [
			'status' => 200,
			'rol' => $rol
		];

		return response()->json($data);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Rol $rol)
	{
		try{
			$rol->delete();

			$data = [
				'status' => 200,
				'rol' => $rol
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

	public function cambiarEstado(Request $request, Rol $rol)
	{
		// Obtener el estado actual
        $estadoActual = $rol->estado;

        // Cambiar el estado de 0 a 1 o de 1 a 0
        $nuevoEstado = ($estadoActual == 0) ? 1 : 0;

        // Actualizar el estado en el modelo y guardar los cambios
        $rol->estado = $nuevoEstado;
        $rol->save();

		$data = [
			'status' => 200,
			'rol' => $rol
		];

		return response()->json($data);
	}
}
