<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$roles = Rol::orderBy('nombre_largo')
        ->get();

        return response()->json($roles);
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
		$rol = new Rol();
        $rol->nombre_corto = $request->nombre_corto;
        $rol->nombre_largo = $request->nombre_largo;
        $rol->save();

        $data = [
			'status' => 201,
			'rol' => $rol
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Rol $rol)
	{
		return response()->json($rol);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Rol $rol)
	{		
		return response()->json($rol);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Rol $rol)
	{
        $rol->nombre_corto = $request->nombre_corto;
        $rol->nombre_largo = $request->nombre_largo;
        $rol->save();

        $data = [
			'status' => 201,
			'rol' => $rol
		];

		return response()->json($data);

	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Rol $rol)
	{
		$rol->delete();

		$data = [
			'status' => 200,
			'rol' => $rol
		];

		return response()->json($data);
	}
}
