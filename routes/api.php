<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CategoriaCertificacionController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TutorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::resource('actividad', ActividadController::class);
Route::resource('categoria_certificacion', CategoriaCertificacionController::class);
Route::resource('estudiante', EstudianteController::class);
Route::resource('programa', ProgramaController::class);
Route::resource('proyecto', ProyectoController::class);
Route::resource('rol', RolController::class);
Route::resource('tutor', TutorController::class);