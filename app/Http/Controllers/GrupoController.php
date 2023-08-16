<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$grupos = Grupo::orderBy('nombre')
		->with(['lineas', 'tutores.proyectos', 'tutores.programa'])
		->get();

		$data = [
			'status' => 200,
			'grupos' => $grupos
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
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Grupo $grupo)
	{
		$data = [
			'status' => 200,
			'grupo' => $grupo
		];

		return response()->json($data);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Grupo $grupo)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Grupo $grupo)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Grupo $grupo)
	{
		//
	}

    public function cambiarEstado(Request $request, Grupo $grupo)
	{
		// Obtener el estado actual
        $estadoActual = $grupo->estado;

        // Cambiar el estado de 0 a 1 o de 1 a 0
        $nuevoEstado = ($estadoActual == 0) ? 1 : 0;

        // Actualizar el estado en el modelo y guardar los cambios
        $grupo->estado = $nuevoEstado;
        $grupo->save();

		$data = [
			'status' => 200,
			'grupo' => $grupo
		];

		return response()->json($data);
	}
}
