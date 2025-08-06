<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;

class Pagina extends Model
{
	use TieneArchivos;
	use EsMultiIdioma;

	protected $table = 'paginas';

	protected $idiomatizados = ['titulo', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];
	protected $fillable = ['titulo', 'link', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];

	protected $dir = [
		'thumbnail' => 'paginas',
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
		return $this->hasMany(ContenidoPagina::class, 'id_pagina')->orderBy('orden');
	}

	public function href()
	{
		if (!$this->ficha_titulo) {
			return '';
		}
		return route('pagina', [$this->slug]);
	}
}
