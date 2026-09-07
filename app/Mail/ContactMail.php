<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $userName;
    public string $userEmail;
    public string $type;
    public string $contactMessage;
    public ?UploadedFile $image;

    public function __construct(
        string $userName,
        string $userEmail,
        string $type,
        string $contactMessage,
        ?UploadedFile $image = null
    ) {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->type = $type;
        $this->contactMessage = $contactMessage;
        $this->image = $image;
    }

    public function build()
    {
        $mail = $this->subject('Nuevo mensaje de contacto - Michis')
            ->replyTo($this->userEmail, $this->userName)
            ->view('emails.contact');
    
        if ($this->image && $this->image->isValid()) {
            $mail->attachData(
                $this->image->get(),
                $this->image->getClientOriginalName(),
                [
                    'mime' => $this->image->getMimeType(),
                ]
            );
        }
    
        return $mail;
    }
}