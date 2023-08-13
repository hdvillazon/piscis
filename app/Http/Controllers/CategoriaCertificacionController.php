<?php

namespace App\Http\Controllers;

use App\Models\CategoriaCertificacion;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoriaCertificacionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$categorias = CategoriaCertificacion::orderBy('nombre')
		->get();

		$data = [
			'status' => 200,
			'categorias' => $categorias
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
		$categoria = new CategoriaCertificacion();
		$categoria->nombre = $request->nombre;
		$categoria->estado = $request->estado;
		$categoria->save();

		$data = [
			'status' => 201,
			'categoria' => $categoria
		];

		return response()->json($data);

	}

	/**
	 * Display the specified resource.
	 */
	public function show(CategoriaCertificacion $categoriaCertificacion)
	{
		$data = [
			'status' => 200,
			'categoria' => $categoriaCertificacion
		];

		return response()->json($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(CategoriaCertificacion $categoriaCertificacion)
	{
		$data = [
			'status' => 200,
			'categoria' => $categoriaCertificacion
		];

		return response()->json($data);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, CategoriaCertificacion $categoriaCertificacion)
	{
		$categoriaCertificacion->nombre = $request->nombre;
		$categoriaCertificacion->estado = $request->estado;
		$categoriaCertificacion->save();

		$data = [
			'status' => 200,
			'categoria' => $categoriaCertificacion
		];

		return response()->json($data);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(CategoriaCertificacion $categoriaCertificacion)
	{
		try{
			$categoriaCertificacion->delete();

			$data = [
				'status' => 200,
				'categoria' => $categoriaCertificacion
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

	public function cambiarEstado(Request $request, CategoriaCertificacion $categoriaCertificacion)
	{
		$categoriaCertificacion->estado = $request->estado;
		$categoriaCertificacion->save();

		$data = [
			'status' => 200,
			'categoriaCertificacion' => $categoriaCertificacion
		];

		return response()->json($data);
	}
}
