<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\StudyTimeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ApprovalController;

// User Authentication Routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user/profile', [UserController::class, 'getProfile']);


// Route to get authenticated user's information (protected by Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Lab Request Routes (protected by Sanctum middleware)
Route::middleware('auth:sanctum')->group(function () {
    // Requests resource routes (index, show, store, update, destroy)
    Route::resource('requests', RequestController::class);

    // Labs resource routes (index, show, store, update, destroy)
    Route::resource('labs', LabController::class);

    // Study times resource routes (index, show, store, update, destroy)
    Route::resource('study-times', StudyTimeController::class);

    // Notifications routes
    Route::get('/notifications', [NotificationController::class, 'index']); // Retrieve notifications
    Route::post('/notifications', [NotificationController::class, 'store']); // Send a notification

    // Mark a notification as read
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);

    // Approval Route
    Route::post('/requests/{id}/approve', [ApprovalController::class, 'approve']); // Approve/reject study times

    // Profile Image Update Route
    Route::post('/user/update-profile-image', [UserController::class, 'updateProfileImage']);
});
