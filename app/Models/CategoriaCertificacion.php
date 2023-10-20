<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoriaCertificacion extends Model
{
	use HasFactory;
	
	protected $table = "categorias_certificacion";
	
	public function estudiantes(): BelongsToMany
	{
		return $this->belongsToMany(Estudiante:: class);
	}
}
