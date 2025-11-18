<?php

namespace App\Models;

use App\Axys\Traits\EsMultiIdioma;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
	use EsMultiIdioma;

	protected $table = 'fichas';

    protected $idiomatizados = ['ficha_titulo', 'ficha_bajada', 'ficha_texto'];
	protected $fillable = ['ficha_titulo', 'ficha_bajada', 'ficha_texto', 'equipo'];

    public function contenidos()
	{
		return $this->hasMany(Contenido::class, 'id_ficha')->orderBy('orden');
	}

    public function miembrosEquipo()
	{
		return $this->hasMany(Equipo::class, 'equipo', 'equipo')->orderBy('orden');
	}

    public function articulo() {
        return $this->morphTo('articulo', 'tipo_articulo', 'id_articulo');
    }
}
