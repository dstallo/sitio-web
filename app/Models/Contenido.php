<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\TieneArchivos;
use App\Axys\AxysVideo as Video;

class Contenido extends Model
{
	use EsOrdenable, TieneArchivos;

    protected $table = 'multimedia';

    protected $fillable = ['nombre', 'video', 'epigrafe'];

    public $dir = ['imagen' => 'multimedia'];

    protected $eliminarConArchivos = ['imagen'];

    protected $thumbnails = [
    	'imagen' => [
            'tn' => [420, 180],
        ]
    ];
    
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

    public function scopeFront($query) {
        return $query
            ->where('visible',true)
            ->orderBy('orden');
    }
    
}
