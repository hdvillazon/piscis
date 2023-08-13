<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SemestreController extends Controller
{

	public function index()
	{
		// Lógica para mostrar una lista de semestres
		$semestres = Semestre::orderBy('numero')
		->get();

		$data = [
			'status' => 200,
			'semestres' => $semestres
		];

		return response()->json($data);
	}

	public function create()
	{
		// Lógica para mostrar el formulario de creación
	}

	public function store(Request $request)
	{
		// Lógica para almacenar un nuevo semestre
		$semestre = new Semestre();
		$semestre->nombre = $request->nombre;
		$semestre->nombre_corto = $request->nombre_corto;
		$semestre->numero = $request->numero;
		$semestre->estado = $request->estado;
		$semestre->save();

		$data = [
			'status' => 201,
			'semestre' => $semestre
		];

		return response()->json($data);
	}

	public function show(Semestre $semestre)
	{
		// Lógica para mostrar los detalles de un semestre específico
		$data = [
			'status' => 200,
			'semestre' => $semestre
		];

		return response()->json($data);
	}

	public function edit(Semestre $semestre)
	{
		// Lógica para mostrar el formulario de edición
		$data = [
			'status' => 200,
			'semestre' => $semestre
		];

		return response()->json($data);
	}

	public function update(Request $request, Semestre $semestre)
	{
		// Lógica para actualizar un semestre existente
		$semestre->nombre = $request->nombre;
		$semestre->nombre_corto = $request->nombre_corto;
		$semestre->numero = $request->numero;
		$semestre->estado = $request->estado;
		$semestre->save();

		$data = [
			'status' => 200,
			'semestre' => $semestre
		];

		return response()->json($data);
	}

	public function destroy(Semestre $semestre)
	{
		// Lógica para eliminar un semestre
		try{
			$semestre->delete();

			$data = [
				'status' => 200,
				'semestre' => $semestre
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

	public function cambiarEstado(Request $request, Semestre $semestre)
	{
		$semestre->estado = $request->estado;
		$semestre->save();

		$data = [
			'status' => 200,
			'semestre' => $semestre
		];

		return response()->json($data);
	}
}
