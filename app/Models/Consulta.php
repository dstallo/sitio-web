<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{

    protected $table = 'consultas';
    protected $fillable = ['nombre', 'email', 'telefono', 'mensaje'];
    
    public function getFechaAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
}
