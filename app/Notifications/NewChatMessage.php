<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChatMessage extends Notification
{
    use Queueable;

    protected string $senderName;

    public function __construct(string $senderName)
    {
        $this->senderName = $senderName;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Has recibido un nuevo mensaje - ValenMiauGesti')
            ->greeting('¡Ey!')
            ->line('Has recibido un nuevo mensaje de "' . $this->senderName . '".')
            ->action('Ver mensajes', route('messages.index'))
            ->line('Entra en ValenMiauGesti para consultar el mensaje y responder.')
            ->salutation('Un saludo, ValenMiauGesti');
    }
}