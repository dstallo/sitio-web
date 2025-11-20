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

    protected static function booted() {
        static::deleting(function($modelo) { //se llama antes del delete en cuestión

            foreach($modelo->contenidos as $contenido) {
                $contenido->delete();
            }
            foreach($modelo->documentos as $documento) {
                $documento->delete();
            }
        });
    }

    public function contenidos()
	{
		return $this->hasMany(Contenido::class, 'id_ficha')->orderBy('orden');
	}

    public function documentos()
	{
		return $this->hasMany(Documento::class, 'id_ficha')->orderBy('orden');
	}

    public function miembrosEquipo()
	{
		return $this->hasMany(Equipo::class, 'equipo', 'equipo')->orderBy('orden');
	}

    public function articulo() {
        return $this->morphTo('articulo', 'tipo_articulo', 'id_articulo');
    }
}
