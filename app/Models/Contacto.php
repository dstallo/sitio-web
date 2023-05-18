<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Contacto
{
    use Notifiable;
    
    public $email;

    function __construct()
    {
        $this->email = config('app.email_notificacion_consulta');
    }
}