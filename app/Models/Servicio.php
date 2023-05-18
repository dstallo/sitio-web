<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;

class Servicio extends Model
{
	use TieneArchivos;
	use EsOrdenable;
	use EsMultiIdioma;

	protected $table = 'servicios';

	protected $idiomatizados = ['titulo', 'texto', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];
	protected $fillable = ['titulo', 'texto', 'link', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];

	protected $dir = [
		'imagen' => 'servicios',
	];

	protected $eliminarConArchivos = ['imagen'];

	public function scopeFront($query)
	{
		return $query->where('visible', true)->orderBy('orden');
	}

	public function contenidos()
	{
		return $this->hasMany(ContenidoServicio::class, 'id_servicio')->orderBy('orden');
	}

	public function href()
	{
		if (!$this->ficha_titulo) {
			return '';
		}
		return route('servicio', [$this, Str::slug($this->titulo)]);
	}
}
