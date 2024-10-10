<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable, HasFactory;

    protected $fillable = ['name', 'email'];

    /**
     * Define the many-to-many relationship between users and notification types.
     */
    public function notificationTypes(): BelongsToMany
    {
        return $this->belongsToMany(NotificationType::class, 'user_notifications');
    }

    /**
     * Define the one-to-many relationship between users and notifications.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
