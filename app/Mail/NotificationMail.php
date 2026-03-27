<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $body;
    public $userName;
    public $notificationType;

    public function __construct($title, $body, $userName = '', $notificationType = 'info')
    {
        $this->title            = $title;
        $this->body             = $body;
        $this->userName         = $userName;
        $this->notificationType = $notificationType;
    }

    public function build()
    {
        return $this->subject($this->title)->view('email-templates.notification-mail');
    }
}
