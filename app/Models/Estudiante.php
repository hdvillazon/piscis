<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Estudiante extends Model
{
	use HasFactory;

	protected $table = "estudiantes";

	protected $appends = ['nombre_completo', 'nombre_completo_invertido', 'nombre_corto'];

	public function actividades(): BelongsToMany
	{
		return $this->belongsToMany(Actividad::class);
	}

	public function categoriasCertificacion(): BelongsToMany
	{
		return $this->belongsToMany(CategoriaCertificacion::class)
		->withPivot('fecha')
		->orderByPivot('fecha', 'desc');
	}

	public function lineas(): BelongsToMany
	{
		return $this->belongsToMany(Proyecto::class)
		->join('linea_proyecto as lp', 'proyectos.id', '=', 'lp.proyecto_id')
		->join('lineas as l', 'lp.linea_id', '=', 'l.id')
		->orderBy('l.nombre')
		->select('l.*');
	}

	public function programa(): BelongsTo
	{
		return $this->belongsTo(Programa::class, 'programa_id');
	}

	public function proyectos():BelongsToMany
	{
		return $this->belongsToMany(Proyecto::class);
	}

	public function semestre():BelongsTo
	{
		return $this->belongsTo(Semestre::class, 'semestre_id');
	}

	public function tipoDocumento():BelongsTo
	{
		return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
	}

	public function tutores():BelongsToMany
	{
		return $this->belongsToMany(Tutor::class);
	}

	public function getNombreCompletoAttribute(){
		$nombre_completo = $this->nombres . ' ' . $this->apellidos;
		return $nombre_completo;
	}

	public function getNombreCompletoInvertidoAttribute(){
		$nombre_completo_invertido = $this->apellidos . ', ' . $this->nombres;
		return $nombre_completo_invertido;
	}

	public function getNombreCortoAttribute(){
		$primer_nombre = explode(' ', $this->nombres)[0];
		$nombre_corto = $primer_nombre . ' ' . substr($this->apellidos, 0, 1) . '.';
		return $nombre_corto;
	}
}
