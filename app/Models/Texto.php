<?php

namespace App\Models;

use App\Axys\Traits\EsMultiIdioma;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Texto extends Model
{
    use HasFactory;
    use EsMultiIdioma;

    public $incrementing = false;
    protected $keyType = 'string';

	protected $table = 'textos';
    protected $idiomatizados = ['texto'];
	protected $fillable = ['texto'];

    protected $cargados;

    public $timestamps = false;

    // Permite obtener un texto en particular.
    public function obtener($id, $lang = null) {

        if (! $this->cargados || ! ($texto = $this->cargados->firstWhere('id', $id))) {
            $texto = Texto::find($id);
        }
        
        if ($texto) {
            if ($lang)
                $attr = 'texto_'.$lang;
            else
                $attr = 'texto';

            return $texto->$attr;
        }

        return null;
    }

    // Permite precargar todos los textos en un objeto tipo Texto.
    static public function cargar() { 
        $texto = new Texto();
        $texto->cargados = Texto::all();
        return $texto;
    }


}
