<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuestas';
    protected $fillable = ['nombre'];

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class, 'id_encuesta')->orderBy('orden');
    }
}
