<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification
{
    use Queueable;

    protected string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Restablecer tu contraseña - ValenMiauGesti')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('Hemos recibido una solicitud para restablecer la contraseña de tu cuenta de ValenMiauGesti.')
            ->action('Restablecer contraseña', $url)
            ->line('Este enlace te permitirá establecer una nueva contraseña.')
            ->line('Si no has solicitado este cambio, puedes ignorar este correo.')
            ->salutation('Un saludo, Christian David Murillo.');
    }
}