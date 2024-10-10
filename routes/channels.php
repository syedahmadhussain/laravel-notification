<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('notifications', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
