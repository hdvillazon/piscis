<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$proyectos = Proyecto::orderBy('nombre')
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
		//
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
		$proyecto->delete();

		$data = [
			'status' => 200,
			'proyecto' => $proyecto
		];

		return response()->json($data);
	}
}
