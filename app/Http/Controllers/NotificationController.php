<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Jobs\SendNotificationJob;
use App\Models\User;

final class NotificationController
{
    public function showNotifications()
    {
        return view('notifications');
    }

    public function subscribeNotification(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'notification_type' => 'required|exists:notification_types,type',
        ]);

        $notificationType = NotificationType::where('type', $request->notification_type)->first();

        $user->notificationTypes()->syncWithoutDetaching([$notificationType->id]);

        return response()->json(['message' => 'Subscription successful.']);
    }

    public function unsubscribeNotification(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'notification_type' => 'required|exists:notification_types,type',
        ]);

        $notificationType = NotificationType::where('type', $request->notification_type)->first();

        $user->notificationTypes()->detach($notificationType->id);

        return response()->json(['message' => 'Unsubscribed successfully.']);
    }

    public function triggerNotification(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|exists:notification_types,type',
            'message' => 'required|string',
        ]);

        $notificationType = NotificationType::where('type', $request->type)->first();

        $users = $notificationType->users;

        foreach ($users as $user) {
            $notification = Notification::create([
                'user_id' => $user->id,
                'type' => $notificationType->type,
                'message' => $request->message,
                'status' => 'pending',
            ]);

            SendNotificationJob::dispatch($notification);
        }

        return response()->json(['message' => 'Notifications have been queued for sending.']);
    }
}
