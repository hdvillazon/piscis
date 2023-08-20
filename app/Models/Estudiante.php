<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function programas(): BelongsTo
    {
        return $this->BelongsTo(Programa::class);
    }

    public function semestres():BelongsTo
    {
        return $this->BelongsTo(Semestre::class);
    }

}
