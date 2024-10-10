<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private readonly Notification $notification)
    {
    }

    public function build(): UserNotificationEmail
    {
        return $this->subject('New Notification')
            ->view('emails.notification')
            ->with([
                'messageContent' => $this->notification->message,
            ]);
    }
}
