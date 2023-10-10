<?php

namespace App\Http\Controllers;


use App\Models\Estudiante;
use App\Models\Semestre;
use App\Models\Programa;
use App\Models\TipoDocumento;
use App\Models\Actividad;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::orderBy('apellidos')
        ->orderBy('nombres')
        ->with(['actividades', 'categoriasCertificacion', 'lineas', 'programa', 'proyectos', 'semestre', 'tipo_documento', 'tutores'])
        ->withSum('actividades as puntosActividades', 'puntos')
        ->get();

        // hector agregue esto para que todos los end points tengan la propiedad nombre
        
        $estudiantes = $estudiantes->map(function ($estudiante) {
            // Crear la propiedad "nombre" con los nombres y apellidos
            $estudiante->nombre = $estudiante->nombres . ' ' . $estudiante->apellidos;
            return $estudiante;
        });

        $data = [
            'status' => 200,
            'estudiantes' => $estudiantes
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programas = Programa::orderBy('nombre')
            ->get();

        $semestres = Semestre::orderBy('numero')
            ->where('estado', 1)
            ->get();

        $tipo_documentos = TipoDocumento::orderBy('nombre_largo')
            ->get();

        $data = [
            'semestres' => $semestres,
            'programas' => $programas,
            'tipo_documentos' => $tipo_documentos
        ];

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $estudiante = new Estudiante();
        $estudiante->nombres = $request->nombres;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->documento = $request->documento;
        $estudiante->codigo_est = $request->codigo_est;
        $estudiante->anio_vinculacion = $request->anio_vinculacion;
        $estudiante->periodo_vinculacion = $request->periodo_vinculacion;
        $estudiante->activo_semillero = $request->activo_semillero;
        $estudiante->correo_institucional = $request->correo_institucional;
        $estudiante->correo_personal = $request->correo_personal;
        $estudiante->telefono = $request->telefono;
        $estudiante->observaciones = $request->observaciones;
        $estudiante->joven_investigador = $request->joven_investigador;
        $estudiante->convocatoria_joven_inv = $request->convocatoria_joven_inv;
        $estudiante->semestre_id = $request->semestre_id;
        $estudiante->programa_id = $request->programa_id;
        $estudiante->tipo_documento_id = $request->tipo_documento_id;
        $estudiante->en_minor = $request->en_minor;
        $estudiante->save();

        $data = [
            'status' => 201,
            'estudiante' => $estudiante
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        $estudiante->load(['actividades', 'categoriasCertificacion', 'programa', 'proyectos', 'semestre', 'tipo_documento', 'tutores.programa'])
        ->loadSum('actividades as puntosActividades', 'puntos');

        // hector: esto es provisional, es para simular, que el end-point estudiantes, devuelve un arreglo de las lineas con las que este está relacionado
        // estas lineas salen de todas aquellas que hacen parte de los proyectos a los que el estudiante esta vincualdo, sin repeticiones de las mismas.
        // entonces lo que hice fue solo agregar el registro como lo necesito para dejar el front terminado 
        // en este sentido todos los estudianes van a aparecer con las mismas 5 lineas, a manera de prueba.
        //
        $estudiante->lineas = [
            [
                'id'=>'210',
                "nombre"=>"Aceites esenciales y extractos naturales"
            ],
            [
                'id'=>'217',
                "nombre"=>"Administración y gestión de enfermería en servicios de salud"
            ]
        ];

        $data = [
            'status' => 200,
            'estudiante' => $estudiante
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $estudiante->nombres = $request->nombres;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->documento = $request->documento;
        $estudiante->codigo_est = $request->codigo_est;
        $estudiante->anio_vinculacion = $request->anio_vinculacion;
        $estudiante->periodo_vinculacion = $request->periodo_vinculacion;
        $estudiante->activo_semillero = $request->activo_semillero;
        $estudiante->correo_institucional = $request->correo_institucional;
        $estudiante->correo_personal = $request->correo_personal;
        $estudiante->telefono = $request->telefono;
        $estudiante->observaciones = $request->observaciones;
        $estudiante->convocatoria_joven_inv = $request->convocatoria_joven_inv;
        $estudiante->semestre_id = $request->semestre_id;
        $estudiante->programa_id = $request->programa_id;
        $estudiante->tipo_documento_id = $request->tipo_documento_id;
        $estudiante->en_minor = $request->en_minor;
        $estudiante->save();

        $data = [
            'status' => 200,
            'estudiante' => $estudiante
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        // Lógica para eliminar un tipo de documento
        try {
            $estudiante->delete();

            $data = [
                'status' => 200,
                'estudiante' => $estudiante
            ];
        } catch (QueryException $ex) {
            $codigoError = $ex->errorInfo[1];

            if ($codigoError == 1451) {
                $data = [
                    'status' => 500,
                    'mensaje' => 'El registro no pudo ser eliminado, ya que tiene relación con otros registros'
                ];
            }
        }

        return response()->json($data);
    }

    // public function cambiarEstado(Request $request, Estudiante $estudiante)
    // {
    //     // Obtener el estado actual
    //     $estadoActual = $estudiante->estado;

    //     // Cambiar el estado de 0 a 1 o de 1 a 0
    //     $nuevoEstado = ($estadoActual == 0) ? 1 : 0;

    //     // Actualizar el estado en el modelo y guardar los cambios
    //     $estudiante->estado = $nuevoEstado;
    //     $estudiante->save();

    // 	$data = [
    // 		'status' => 200,
    // 		'estudiante' => $estudiante
    // 	];

    // 	return response()->json($data);
    // }
    
    public function asignarActividades (Request $request, Estudiante $estudiante){

        $estudiante->actividades()->sync($request->actividades);

        $estudiante->load(['actividades', 'categoriasCertificacion', 'programa', 'proyectos', 'semestre', 'tipo_documento', 'tutores'])
        ->loadSum('actividades as puntosActividades', 'puntos');
        
        $data = [
			'status' => 200,
			'estudiante' => $estudiante
		];

        return response()->json($data);
    }
    
}
