<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programas = Programa::orderBy('nombre')
        ->get();

        return response()->json($programas);
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
        $programa = new Programa();
        $programa->nombre = $request->nombre;
        $programa->acronimo = $request->acronimo;
        $programa->estado = $request->estado;
        $programa->save();

        $data = [
			'status' => 201,
			'programa' => $programa
		];

		return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Programa $programa)
    {
        return response()->json($programa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programa $programa)
    {
        return response()->json($programa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programa $programa)
    {
        $programa->nombre = $request->nombre;
        $programa->acronimo = $request->acronimo;
        $programa->estado = $request->estado;
        $programa->save();

        $data = [
			'status' => 200,
			'programa' => $programa
		];

		return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programa $programa)
    {
        $programa->delete();

		$data = [
			'status' => 200,
			'programa' => $programa
		];

		return response()->json($data);
    }
}
