<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matriculados extends Model
{
	use HasFactory;

	protected $table = "matriculados";

	protected $fillable = ['anio', 'periodo', 'cantidad', 'programa_id'];

	public function programa(): BelongsTo
	{
		return $this->belongsTo(Programa::class);
	}
}
