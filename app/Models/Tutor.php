<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tutor extends Model
{
	use HasFactory;

	protected $table = "tutores";

	public function grupo(): BelongsTo
	{
		return $this->belongsTo(Grupo::class);
	}

	public function programa(): BelongsTo
	{
		return $this->belongsTo(Programa::class);
	}

	public function tipoDocumento(): BelongsTo
	{
		return $this->belongsTo(TipoDocumento::class);
	}
}
