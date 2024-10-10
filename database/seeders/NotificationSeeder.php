<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\NotificationType;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(10)->create();

        $types = [
            ['type' => 'alert'],
            ['type' => 'news'],
            ['type' => 'update'],
        ];

        NotificationType::insert($types);

        $users = User::all();
        $notificationTypes = NotificationType::all();

        foreach ($users as $user) {
            foreach ($notificationTypes as $type) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => $type->type,
                    'message' => "This is a {$type->type} notification for {$user->name}.",
                    'status' => 'pending',
                ]);
            }
        }
    }
}
