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
        $semestres = Semestre::orderBy('nombre')
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
    }

    public function show(Semestre $semestre)
    {
        // Lógica para mostrar los detalles de un semestre específico
        $data = [
            'status' => 200,
            'semestre' => $semestre
        ];
    }

    public function edit($id)
    {
        // Lógica para mostrar el formulario de edición
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un semestre existente
    }

    public function destroy($id)
    {
        // Lógica para eliminar un semestre
    }
}
