<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\EsMultiIdioma;

class Pregunta extends Model
{
	use EsOrdenable;
	use EsMultiIdioma;

	protected $table = 'preguntas';
	protected $idiomatizados = ['pregunta'];
	protected $fillable = ['pregunta'];

	public function encuesta()
	{
		return $this->belongsTo(Encuesta::class, 'id_encuesta');
	}

	public function opciones()
	{
		return $this->hasMany(Opcion::class, 'id_pregunta')->orderBy('orden');
	}
}
