<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\TieneArchivos;
use App\Axys\AxysVideo as Video;

class ContenidoServicio extends Model
{
    use EsOrdenable, TieneArchivos;

    protected $table = 'contenidos_servicios';

    protected $fillable = ['nombre', 'video', 'epigrafe'];

    public $dir = ['imagen' => 'servicios/multimedia'];

    protected $eliminarConArchivos = ['imagen'];

    protected $thumbnails = [
        'imagen' => [
            'tn' => [1290, 585],
        ]
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
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
    
}
