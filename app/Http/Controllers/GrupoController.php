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

		// ------------------------ revisar si esta correcta la adición de un nuevo grupo

		$grupo = new grupo();
		$grupo->nombre = $request->nombre;
		$grupo->codigo = $request->codigo;
		$grupo->acronimo = $request->acronimo;
		$grupo->estado = $request->estado;
		$grupo->categoria = $request->categoria;
		$grupo->save();

		$data = [
			'status' => 201,
			'actividad' => $grupo
		];

		return response()->json($data);
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
		//este objeto es de muestra
		// la idea es hacer que se puedan actualizar los grupos, objeto representa el resutlado despues de actualizar un grupo
		// objeto es el registro actualizado enviado al font-end
		// --- hector ---
		$objeto = [
			"id"=> 4,
            "nombre"=> "Altos estudios de Frontera - ALEF",
            "codigo"=> "COL0041025",
            "acronimo"=> null,
            "estado"=> 1,
            "categoria"=> "A1",
            "created_at"=> "2023-05-01T05:00:00.000000Z",
            "updated_at"=> "2023-09-15T12:32:35.000000Z",
		];
		//;
		$data = [
			'status' => 'sin implementar',
			'grupo' => $objeto
		];

		return response()->json($data);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Grupo $grupo)
	{
		// este objeto es de muestra
		// la idea es hacer que se puedan eliminar los grupos, objeto representa el resutlado despues de borrar un grupo
		// objeto es el registro borrado enviado al font-end
		// --- hector ---
		$objeto = [
			"id"=> 4,
            "nombre"=> "Altos estudios de Frontera - ALEF",
            "codigo"=> "COL0041025",
            "acronimo"=> null,
            "estado"=> 1,
            "categoria"=> "A1",
            "created_at"=> "2023-05-01T05:00:00.000000Z",
            "updated_at"=> "2023-09-15T12:32:35.000000Z",
		];
		//;
		$data = [
			'status' => 'sin implementar',
			'grupo' => $objeto
		];

		return response()->json($data);
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
