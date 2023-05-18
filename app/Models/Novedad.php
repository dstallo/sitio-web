<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;

class Novedad extends Model
{
	use TieneArchivos;
	use EsMultiIdioma;

	protected $table = 'novedades';

	protected $idiomatizados = ['titulo', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];
	protected $fillable = ['titulo', 'link', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];

	protected $dir = [
		'thumbnail' => 'novedades',
	];

	protected $eliminarConArchivos = ['thumbnail'];

	public function scopeFront($query)
	{
		return $query
			->where('visible', true)
			->orderBy('created_at', 'desc');
	}

	public function contenidos()
	{
		return $this->hasMany(ContenidoNovedad::class, 'id_novedad')->orderBy('orden');
	}

	public function href()
	{
		if (!$this->ficha_titulo) {
			return '';
		}
		return route('novedad', [$this, Str::slug($this->titulo)]);
	}
}
