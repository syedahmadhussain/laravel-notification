<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NotificationType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    /**
     * Define the many-to-many relationship with users.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_notifications');
    }
}
