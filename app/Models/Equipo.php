<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\TieneArchivos;
use App\Axys\Traits\EsOrdenable;

class Equipo extends Model
{
    use TieneArchivos, EsOrdenable;

    protected $table = 'equipos';

    protected $fillable = ['nombre', 'descripcion', 'equipo'];

    protected $dir = [
        'imagen' => 'equipos',
    ];

    protected $eliminarConArchivos = ['imagen'];

    public function scopeFront($query) {
        return $query
            ->where('visible',true)
            ->orderBy('equipo', 'asc')
            ->orderBy('orden', 'asc');
    }

    static public function list() {
        return Equipo::select('equipo')->whereNotNull('equipo')->groupBy('equipo')->orderBy('equipo', 'asc')->get()->pluck('equipo')->all();
    }
}
