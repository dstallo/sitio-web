<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;

class Sucursal extends Model
{
	use TieneArchivos;
	use EsMultiIdioma;

	protected $table = 'sucursales';

	protected $idiomatizados = ['bajada'];
	protected $fillable = ['nombre', 'link', 'bajada', 'direccion', 'telefono', 'horarios', 'email'];

	protected $dir = [
		'thumbnail' => 'sucursales',
	];

	protected $eliminarConArchivos = ['thumbnail'];

	public function scopeFront($query)
	{
		return $query
			->where('visible', true)
			->orderBy('created_at', 'desc');
	}
}
