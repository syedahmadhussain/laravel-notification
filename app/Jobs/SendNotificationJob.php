<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Events\NotificationSent;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Notification $notification)
    {}

    public function handle(): void
    {
        Mail::raw($this->notification->message, function ($message) {
            $message->to($this->notification->user->email)
                ->subject('New Notification');
        });

        event(new NotificationSent($this->notification));

        $this->notification->update(['status' => 'sent']);

    }
}
