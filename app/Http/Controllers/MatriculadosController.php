<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Matriculados;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MatriculadosController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$programas = Programa::orderBy('nombre')
		->with(['matriculados' => function($q){
			$hoy = Carbon::now();
			$ano = $hoy->year;
			$periodo = $hoy->month <= 6 ? 1 : 2;

			$q->where('anio', $ano)
			->where('periodo', $periodo);
		}])
		->get();

		$data = [
			'status' => 200,
			'programas' => $programas
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
		$hoy = Carbon::now();
		$ano = $hoy->year;
		$periodo = $hoy->month <= 6 ? 1 : 2;

		$matriculados = Matriculados::updateOrCreate(
			['anio' => $ano, 'periodo' => $periodo, 'programa_id' => $request->programa_id],
			['cantidad' => $request->cantidad]
		);

		$data = [
			'status' => 201,
			'matriculados' => $matriculados
		];

		return response()->json($data);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Matriculados $matriculados)
	{
	   //
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Matriculados $matriculados)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Matriculados $matriculados)
	{

		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Matriculados $matriculados)
	{
	
	}
}
