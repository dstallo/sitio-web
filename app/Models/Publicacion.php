<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Axys\Traits\TieneArchivos;
use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsMultiIdioma;
use App\Axys\Traits\EsOrdenable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Publicacion extends Model
{
	use TieneArchivos;
    use EsOrdenable;
	use EsMultiIdioma;

	protected $table = 'publicaciones';

	protected $idiomatizados = ['titulo'];
	protected $fillable = ['titulo', 'link', 'destacado', 'categoria'];

	protected $dir = [
		'thumbnail' => 'publicaciones',
	];

    protected $with = [
        'ficha'
    ];

	protected $eliminarConArchivos = ['thumbnail'];

	public function scopeFront($query)
	{
		return $query
			->where('visible', true)
			->orderBy('orden');
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

            return route('publicacion', [$this, Str::slug($this->titulo)]);
        }
        elseif ($type == 'edit') {
            return route('editar_publicacion', [$this]);
        }
        elseif ($type == 'list') {
            return route('admin.publicaciones');
        }
        elseif ($type == 'delete') {
            return route('eliminar_publicacion', [$this]);
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

    static public function categorias() {
        return Publicacion::select('categoria', DB::raw('MIN(orden) as orden'))->whereNotNull('categoria')->groupBy('categoria')->orderBy('orden', 'asc')->get()->pluck('categoria')->all();
    }

}
