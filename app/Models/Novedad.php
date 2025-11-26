<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;
use App\Axys\Traits\EsOrdenable;
use Illuminate\Http\Request;

class Novedad extends Model
{
	use TieneArchivos;
    use EsOrdenable;
	use EsMultiIdioma;

	protected $table = 'novedades';

	protected $idiomatizados = ['titulo'];
	protected $fillable = ['titulo', 'link', 'destacado'];

	protected $dir = [
		'thumbnail' => 'novedades',
	];

    protected $with = [
        'ficha'
    ];

	protected $eliminarConArchivos = ['thumbnail'];

	public function scopeFront($query)
	{
		return $query
			->where('visible', true)
			->orderBy('orden', 'asc');
	}

	public function contenidos()
	{
		return $this->ficha?->contenidos() ?? collect([]);
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

            return route('novedad', [$this, Str::slug($this->titulo)]);
        }
        elseif ($type == 'edit') {
            return route('editar_novedad', [$this]);
        }
        elseif ($type == 'list') {
            return route('admin.novedades');
        }
        elseif ($type == 'delete') {
            return route('eliminar_novedad', [$this]);
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
