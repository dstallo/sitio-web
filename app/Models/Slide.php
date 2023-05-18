<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\TieneArchivos;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\EsMultiIdioma;

class Slide extends Model
{
	use EsOrdenable;
	use TieneArchivos;
	use EsMultiIdioma;

	protected $table = 'slides';

	protected $idiomatizados = ['titulo'];
	protected $fillable = ['titulo', 'link'];

	protected $dir = [
		'imagen' => 'slides',
		'imagen_vertical' => 'slides'
	];

	protected $eliminarConArchivos = ['imagen', 'imagen_vertical'];

	public function getVertical()
	{
		if ($this->tiene('imagen_vertical')) {
			return $this->url('imagen_vertical');
		}
		return $this->url('imagen');
	}

	public function scopeFront($query)
	{
		return $query->where('visible', true)->orderBy('orden');
	}
}
