<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Linea;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LineaController extends Controller
{
    public function index()
	{
		$lineas = Linea::orderBy('nombre')
		->orderBy('nombre')
		->with('grupos')
		->get();

		$data = [
			'status' => 200,
			'lineas' => $lineas
		];

		return response()->json($data);
	}

	public function create()
	{
		
	}

	public function store(Request $request)
	{
		
	}

	public function show(Linea $linea)
	{
		$data = [
			'status' => 200,
			'tutor' => $linea
		];

		return response()->json($data);
	}

	public function edit(Linea $linea)
	{
		
	}

	public function update(Request $request, Linea $linea)
	{
		
	}

	public function destroy(Linea $linea)
	{
		
	}

	public function cambiarEstado(Request $request, Linea $linea)
	{
		// Obtener el estado actual
        $estadoActual = $linea->estado;

        // Cambiar el estado de 0 a 1 o de 1 a 0
        $nuevoEstado = ($estadoActual == 0) ? 1 : 0;

		$linea->estado = $nuevoEstado;
		$linea->save();

		$data = [
			'status' => 200,
			'linea' => $linea
		];

		return response()->json($data);
	}
}
