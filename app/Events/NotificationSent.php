<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

readonly class NotificationSent implements ShouldBroadcast
{
    public function __construct(private Notification $notification)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('notifications');
    }

    public function broadcastWith(): array
    {
        return [
          'user' => $this->notification->user->email,
          'type' => $this->notification->type,
          'message'=> $this->notification->message,
          'status'=> $this->notification->status,
        ];
    }
}
