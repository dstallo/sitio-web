<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;

class Opcion extends Model
{
    use EsOrdenable;
    
    protected $table = 'opciones';
    protected $fillable = ['valor'];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'id_pregunta');
    }
}
