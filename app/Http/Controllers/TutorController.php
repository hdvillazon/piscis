<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tutores = Tutor::orderBy('nombres')
        ->with('grupo')
        ->with('programa')
		->orderBy('apellidos')
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
		//
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
		$tutor->tipo_documento_id = $request->tipo_documento_id;
		$tutor->save();

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
		$tutor->tipo_documento_id = $request->tipo_documento_id;
		$tutor->save();

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
		$tutor->delete();

		$data = [
			'status' => 200,
			'tutor' => $tutor
		];

		return response()->json($data);
	}
}
