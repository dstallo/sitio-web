<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\TieneArchivos;
use App\Axys\Traits\EsOrdenable;

class Servicio extends Model
{
    use TieneArchivos, EsOrdenable;

    protected $table = 'servicios';

    protected $fillable = ['titulo', 'texto', 'link', 'ficha_titulo', 'ficha_bajada', 'ficha_texto'];

    protected $dir = [
        'imagen' => 'servicios',
    ];

    protected $eliminarConArchivos = ['imagen'];

    public function scopeFront($query) {

    	return $query->where('visible', true)->orderBy('orden');
    }

    public function contenidos()
    {
        return $this->hasMany(ContenidoServicio::class, 'id_servicio')->orderBy('orden');
    }

    public function href()
    {
        if(!$this->ficha_titulo) return '';
        return route('servicio', [$this, \Str::slug($this->titulo)]);
    }
}
