<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CategoriaCertificacionController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MatriculadosController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\TipoDocumentoController;
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

Route::patch('actividad/{actividad}/desactivar', [ActividadController::class, 'desactivar']);
Route::resource('actividad', ActividadController::class);

Route::patch('categoria_certificacion/{categoriaCertificacion}/desactivar', [CategoriaCertificacionController::class, 'desactivar']);
Route::resource('categoria_certificacion', CategoriaCertificacionController::class);

Route::resource('estudiante', EstudianteController::class);

Route::resource('matriculados', MatriculadosController::class)->parameters(['matriculados' => 'matriculados']);

Route::patch('programa/{programa}/desactivar', [ProgramaController::class, 'desactivar']);
Route::patch('programa/{programa}/activar', [ProgramaController::class, 'activar']);
Route::resource('programa', ProgramaController::class);

Route::resource('proyecto', ProyectoController::class);

Route::patch('rol/{rol}/desactivar', [RolController::class, 'desactivar']);
Route::resource('rol', RolController::class);

Route::resource('tutor', TutorController::class);

Route::patch('semestre/{semestre}/desactivar', [SemestreController::class, 'desactivar']);
Route::patch('semestre/{semestre}/activar', [SemestreController::class, 'activar']);
Route::resource('semestre', SemestreController::class);

Route::resource('tipo_documento', TipoDocumentoController::class);
