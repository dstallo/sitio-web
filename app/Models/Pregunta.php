<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;

class Pregunta extends Model
{
    use EsOrdenable;
    
    protected $table = 'preguntas';
    protected $fillable = ['pregunta'];

    public function encuesta()
    {
    	return $this->belongsTo(Encuesta::class, 'id_encuesta');
    }

    public function opciones()
    {
        return $this->hasMany(Opcion::class, 'id_pregunta')->orderBy('orden');
    }
}
