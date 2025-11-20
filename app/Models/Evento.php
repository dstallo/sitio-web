<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;

class Evento extends Model
{
	use EsMultiIdioma;

	protected $table = 'agenda';

	protected $idiomatizados = ['titulo'];
	protected $fillable = ['titulo', 'link', 'fecha'];
    protected $casts = [
        'fecha' => 'datetime'
    ];

	public function scopeFront($query)
	{
		return $query
			->where('visible', true)
			->orderBy('fecha', 'asc');
	}
}
