<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{

	public function index()
	{
		// Lógica para mostrar una lista de tipo de documentos
		$tiposDocumento = TipoDocumento::orderBy('nombre_largo')
		->get();

		$data = [
			'status' => 200,
			'tipo_documentos' => $tiposDocumento
		];

		return response()->json($data);
	}

	public function create()
	{
		// Lógica para mostrar el formulario de creación
	}

	public function store(Request $request)
	{
		// Lógica para almacenar un nuevo tipo de documento
		$tipoDocumento = new TipoDocumento();
		$tipoDocumento->nombre_largo = $request->nombre_largo;
		$tipoDocumento->nombre_corto = $request->nombre_corto;
		$tipoDocumento->save();

		$data = [
			'status' => 201,
			'tipoDocumento' => $tipoDocumento
		];

		return response()->json($data);
	}

	public function show(TipoDocumento $tipoDocumento)
	{
		// Lógica para mostrar los detalles de un tipo de documento específico
		$data = [
			'status' => 200,
			'tipo_documentos' => $tipoDocumento
		];

		return response()->json($data);
	}

	public function edit(TipoDocumento $tipoDocumento)
	{
		// Lógica para mostrar el formulario de edición
		$data = [
			'status' => 200,
			'tipo_documentos' => $tipoDocumento
		];

		return response()->json($data);
	}

	public function update(Request $request, TipoDocumento $tipoDocumento)
	{
		// Lógica para actualizar un tipo de documento existente
		$tipoDocumento->nombre_largo = $request->nombre_largo;
		$tipoDocumento->nombre_corto = $request->nombre_corto;
		$tipoDocumento->save();

		$data = [
			'status' => 200,
			'tipoDocumento' => $tipoDocumento
		];

		return response()->json($data);
	}

	public function destroy(TipoDocumento $tipoDocumento)
	{
		// Lógica para eliminar un tipo de documento
		try{
			$tipoDocumento->delete();

			$data = [
				'status' => 200,
				'tipoDocumento' => $tipoDocumento
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
}
