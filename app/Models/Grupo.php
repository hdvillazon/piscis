<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Grupo extends Model
{
	use HasFactory;

	protected $table = "grupos";

	public function tutores(): HasMany
	{
		return $this->hasMany(Tutor::class);
	}

	public function lineas(): BelongsToMany
	{
		return $this->belongsToMany(Linea::class);
	}

	

}
