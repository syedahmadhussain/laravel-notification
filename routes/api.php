<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::post('/users/{user}/subscribe', [NotificationController::class, 'subscribeNotification']);
Route::post('/notifications/trigger', [NotificationController::class, 'triggerNotification']);
Route::post('/users/{user}/unsubscribe', [NotificationController::class, 'unsubscribeNotification']);
