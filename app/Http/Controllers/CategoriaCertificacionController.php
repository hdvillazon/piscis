<?php

namespace App\Http\Controllers;

use App\Models\CategoriaCertificacion;
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
			'categoria' => $categoria
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
		$categoriaCertificacion->delete();

		$data = [
			'status' => 200,
			'categoria' => $categoriaCertificacion
		];

		return response()->json($data);
	}
}
