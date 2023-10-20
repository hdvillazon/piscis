<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Actividad extends Model
{
	use HasFactory;

	protected $table = "actividades";

	public function estudiantes(): BelongsToMany
	{
		return $this->BelongsToMany(Estudiante::class);
	}


}
