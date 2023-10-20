<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Linea extends Model
{
	use HasFactory;

	protected $table = "lineas";

	public function grupos(): BelongsToMany
	{
		return $this->belongsToMany(Grupo::class);
	}

	public function proyectos(): BelongsToMany
	{
		return $this->belongsToMany(Proyecto::class);
	}
	
	public function tutores():BelongsToMany
	{
		return $this->belongsToMany(Tutor::class);
	}
}
