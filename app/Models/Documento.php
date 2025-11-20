<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\TieneArchivos;
use App\Axys\AxysVideo as Video;

class Documento extends Model
{
    use EsOrdenable, TieneArchivos;

    protected $table = 'documentos_fichas';

    protected $fillable = ['nombre', 'tipo', 'descripcion'];

    public $dir = ['archivo' => 'documentos'];

    protected $eliminarConArchivos = ['archivo'];

    public function scopeFront($query)
	{
		return $query
            ->whereNull('id_ficha')
			->where('visible', true)
			->orderBy('orden', 'asc');
	}

    public function ficha()
    {
        return $this->belongsTo(Ficha::class, 'id_ficha');
    }

    public function href($type) {
        if ($type == 'edit') {
            if ($this->ficha)
                return route('editar_documento_ficha', ['ficha' => $this->ficha, 'documento' => $this]);
            else
                return route('editar_documento', ['documento' => $this]);
        }
        else if ($type == 'delete') {
            if ($this->ficha)
                return route('eliminar_documento_ficha', ['ficha' => $this->ficha, 'documento' => $this]);
            else
                return route('eliminar_documento', ['documento' => $this]);
        }
        else if ($type == 'logo') {
            if ($this->tipo && is_file(public_path('img/documentos/'. $this->tipo . '.svg')))
                return url('img/documentos/'. $this->tipo . '.svg');
            return url('img/documentos/default.svg');
        }
    }
    
}
