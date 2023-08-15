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
}
