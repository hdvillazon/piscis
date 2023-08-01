<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proyecto extends Model
{
	use HasFactory;

	protected $table = "proyectos";

	public function estudiantes(): BelongsToMany
	{
		return $this->belongsToMany(Estudiante::class);
	}

	public function lineas(): BelongsToMany
	{
		return $this->belongsToMany(Linea::class);
	}

	public function tutores(): BelongsToMany
	{
		return $this->belongsToMany(Tutor::class);
	}
}
