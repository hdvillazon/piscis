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
}
