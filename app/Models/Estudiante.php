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

    public function actividades(): BelongsToMany
	{
		return $this->belongsToMany(Actividad::class);
	}

    public function categorias_certificacion(): BelongsToMany
	{
		return $this->belongsToMany(CategoriaCertificacion::class);
	}

    public function programa(): BelongsTo
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }

    public function semestre():BelongsTo
    {
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }

    public function proyectos():BelongsToMany
    {
        return $this->belongsToMany(Proyecto::class);
    }

    public function tipo_documento():BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    public function tutores():BelongsToMany
    {
        return $this->belongsToMany(Tutor::class);
    }

    // public function lineas():HasManyThrough
    // {
    //     return $this->hasManyThrough(Linea::class, Proyecto::class);
    // }

}
