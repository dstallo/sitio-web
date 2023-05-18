<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Consulta;

class NuevaConsulta extends Notification
{

    protected $consulta;
    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct(Consulta $consulta)
    {
        $this->consulta = $consulta;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nueva consulta en el sitio')
            ->greeting('Se recibió una nueva consulta:')
            ->line('ID: ' . $this->consulta->id)
            ->line('Nombre: ' . $this->consulta->nombre)
            ->line('Email: ' . $this->consulta->email)
            ->line('Teléfono: ' . $this->consulta->telefono)
            ->line('Mensaje: ' . $this->consulta->mensaje)
            ->action('Ver en el panel', route('editar_consulta', $this->consulta))
        ;
    }
}
