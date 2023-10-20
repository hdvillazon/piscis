<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programa extends Model
{
	use HasFactory;

	protected $table = "programas";

	public function matriculados(): HasMany
	{
		return $this->hasMany(Matriculados::class);
	}

    public function estudiantes(): HasMany
	{
		return $this->hasMany(Estudiantes::class);
	}
	public function tutores(): HasMany
	{
		return $this->hasMany(Tutor::class);
	}
}
