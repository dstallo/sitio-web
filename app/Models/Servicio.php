<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;
use Illuminate\Http\Request;

class Servicio extends Model
{
	use TieneArchivos;
	use EsOrdenable;
	use EsMultiIdioma;

	protected $table = 'servicios';

	protected $idiomatizados = ['titulo', 'texto', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];
	protected $fillable = ['titulo', 'texto', 'link'];

	protected $dir = [
		'imagen' => 'servicios',
	];

    protected $with = [
        'ficha'
    ];

	protected $eliminarConArchivos = ['imagen'];

	public function scopeFront($query)
	{
		return $query->where('visible', true)->orderBy('orden');
	}

	public function contenidos()
	{
		return $this->ficha()->contenidos();
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

            return route('servicio', [$this, Str::slug($this->titulo)]);
        }
        elseif ($type == 'edit') {
            return route('editar_servicio', [$this]);
        }
        elseif ($type == 'list') {
            return route('servicios');
        }
        elseif ($type == 'delete') {
            return route('eliminar_servicio', [$this]);
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
