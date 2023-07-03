<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
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

		return response()->json($actividades);
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
		return response()->json($actividad);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Actividad $actividad)
	{
		return response()->json($actividad);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Actividad $actividad)
	{
		$actividad->nombre = $request->nombre;
		$actividad->puntos = $request->puntos;
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
		//
	}
}
