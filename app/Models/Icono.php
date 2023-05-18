<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\TieneArchivos;
use App\Axys\Traits\EsOrdenable;

class Icono extends Model
{
    use TieneArchivos, EsOrdenable;

    protected $table = 'iconos';

    protected $fillable = ['nombre', 'link'];

    protected $dir = [
        'imagen' => 'iconos',
    ];

    protected $eliminarConArchivos = ['imagen'];

    public function scopeFront($query) {
        return $query
            ->where('visible',true)
            ->orderBy('orden', 'asc');
    }
}
