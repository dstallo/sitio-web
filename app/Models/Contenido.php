<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\TieneArchivos;
use App\Axys\AxysVideo as Video;

class Contenido extends Model
{
    use EsOrdenable, TieneArchivos;

    protected $table = 'contenidos_fichas';

    protected $fillable = ['nombre', 'video', 'epigrafe'];

    public $dir = ['imagen' => 'multimedia'];

    protected $eliminarConArchivos = ['imagen'];

    protected $thumbnails = [
        'imagen' => [
            'tn' => [1290, 585],
        ]
    ];

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

    public function getVideo()
    {
        if(empty($this->video)) {
            return null;
        }
        $video = new Video($this->video);
        if($video->ok()) {
            return $video;
        }
        return null;
    }

    public function href($type) {
        if ($type == 'edit') {
            if ($this->ficha)
                return route('editar_contenido_ficha', ['ficha' => $this->ficha, 'contenido' => $this]);
            else
                return route('editar_contenido', ['contenido' => $this]);
        }
        else if ($type == 'delete') {
            if ($this->ficha)
                return route('eliminar_contenido_ficha', ['ficha' => $this->ficha, 'contenido' => $this]);
            else
                return route('eliminar_contenido', ['contenido' => $this]);
        }
    }
    
}
