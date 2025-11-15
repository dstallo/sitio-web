<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;
use Illuminate\Http\Request;

class Pagina extends Model
{
	use TieneArchivos;
	use EsMultiIdioma;

	protected $table = 'paginas';

	protected $idiomatizados = ['titulo', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];
	protected $fillable = ['titulo', 'link'];

	protected $dir = [
		'thumbnail' => 'paginas',
	];

    protected $with = [
        'ficha'
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
		return $this->hasManyThrough(Contenido::class, Ficha::class, 'id_articulo', 'id_ficha')->where('tipo_articulo', static::class);
	}

    public function ficha(){
        return $this->morphOne(Ficha::class, 'articulo', 'tipo_articulo', 'id_articulo');
    }

	public function href($type = 'view')
	{   
		if ($type == 'view') {
            if ($this->link)
                return $this->link;

            if (! $this->ficha) {
                return '#';
            }

            return route('pagina', [$this]);
        }
        elseif ($type == 'edit') {
            return route('editar_pagina', [$this]);
        }
        elseif ($type == 'list') {
            return route('paginas');
        }
        elseif ($type == 'delete') {
            return route('eliminar_pagina', [$this]);
        }
	}

    public function guardarFicha(Request $request) {
        $ficha = $this->ficha;
        if (! $ficha)
            $ficha = new Ficha();
        
        $ficha->fill($request->all());
        $ficha->articulo()->associate($this);
        $ficha->save();
    }
}
