<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CategoriaCertificacionController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\LineaController;
use App\Http\Controllers\MatriculadosController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\TipoDocumentoController;
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

Route::patch('actividad/{actividad}/cambiar_estado', [ActividadController::class, 'cambiarEstado']);
Route::resource('actividad', ActividadController::class);

Route::patch('categoria_certificacion/{categoriaCertificacion}/cambiar_estado', [CategoriaCertificacionController::class, 'cambiarEstado']);
Route::resource('categoria_certificacion', CategoriaCertificacionController::class);

Route::patch('estudiante/{estudiante}/asignar_actividad', [EstudianteController::class, 'asignarActividad']);
Route::patch('estudiante/{estudiante}/asignar_categoria', [EstudianteController::class, 'asignarCategoria']);
Route::patch('estudiante/{estudiante}/cambiar_estado', [EstudianteController::class, 'cambiarEstado']);
Route::resource('estudiante', EstudianteController::class);

Route::patch('grupo/{grupo}/cambiar_estado', [GrupoController::class, 'cambiarEstado']);
Route::resource('grupo', GrupoController::class);

Route::patch('linea/{linea}/cambiar_estado', [LineaController::class, 'cambiarEstado']);
Route::resource('linea', LineaController::class);

Route::resource('matriculados', MatriculadosController::class)->parameters(['matriculados' => 'matriculados']);

Route::patch('programa/{programa}/cambiar_estado', [ProgramaController::class, 'cambiarEstado']);
Route::resource('programa', ProgramaController::class);

Route::patch('proyecto/{proyecto}/asignar_estudiante', [ProyectoController::class, 'asignarEstudiante']);
Route::patch('proyecto/{proyecto}/cambiar_estado', [ProyectoController::class, 'cambiarEstado']);
Route::resource('proyecto', ProyectoController::class);

Route::patch('rol/{rol}/cambiar_estado', [RolController::class, 'cambiarEstado']);
Route::resource('rol', RolController::class);

Route::patch('semestre/{semestre}/cambiar_estado', [SemestreController::class, 'cambiarEstado']);
Route::resource('semestre', SemestreController::class);

Route::resource('tipo_documento', TipoDocumentoController::class);

Route::patch('tutor/{tutor}/asignar_estudiante', [TutorController::class, 'asignarEstudiante']);
Route::patch('tutor/{tutor}/cambiar_estado', [TutorController::class, 'cambiarEstado']);
Route::resource('tutor', TutorController::class);
