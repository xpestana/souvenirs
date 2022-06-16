<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    private string $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail( $notifiable ) {
        $link = route("password.reset", ["token" => $this->token]);
        return ( new MailMessage )
            ->greeting("Hola,")
            ->subject( 'Restablecer contraseña')
            ->line( "Recibes este correo electrónico porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta.")
            ->action( 'Restablecer ahora', $link)
            ->line( 'Si no has solicitado el restablecimiento de tu contraseña puedes olvidar este mensaje.')
            ->line( 'Este enlace caducará en 60 minutos.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}