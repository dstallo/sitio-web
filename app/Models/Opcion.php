<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\EsMultiIdioma;

class Opcion extends Model
{
	use EsOrdenable;
	use EsMultiIdioma;

	protected $table = 'opciones';
	protected $idiomatizados = ['valor'];
	protected $fillable = ['valor'];

	public function pregunta()
	{
		return $this->belongsTo(Pregunta::class, 'id_pregunta');
	}
}
