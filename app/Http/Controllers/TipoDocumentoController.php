<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function index()
{
    // Lógica para mostrar una lista de tipo de documentos
    $tipo_documentos = TipoDocumento::orderBy('nombre_largo')
    ->get();

    $data = [
        'status' => 200,
        'tipo_documentos' => $tipo_documentos
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
}

public function show(TipoDocumento $tipo_documentos)
{
    // Lógica para mostrar los detalles de un tipo de documento específico
    $data = [
        'status' => 200,
        'tipo_documentos' => $tipo_documentos
    ];

    return response()->json($data);
}

public function edit($id)
{
    // Lógica para mostrar el formulario de edición
}

public function update(Request $request, $id)
{
    // Lógica para actualizar un tipo de documento existente
}

public function destroy($id)
{
    // Lógica para eliminar un tipo de documento
}

}
