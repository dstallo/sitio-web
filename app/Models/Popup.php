<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\TieneArchivos;

class Popup extends Model
{
	use TieneArchivos;

	protected $table = 'popups';

    protected $fillable = [
    	'nombre', 'link'
    ];


    protected $dir = [
        'imagen' => 'popups',
        'imagen_vertical' => 'popups',
    ];
    protected $eliminarConArchivos = ['imagen', 'imagen_vertical'];

}