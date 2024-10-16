<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Retrieve notifications for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();

        // Get all unread notifications for the user
        $notifications = Notification::where('user_id', $user->id)
                                      ->where('is_read', false)
                                      ->get();

        return response()->json($notifications);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($id)
    {
        $user = Auth::user();

        // Find the notification for the user
        $notification = Notification::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read'], 200);
    }

    /**
     * Send a notification to a user
     */
    public function store(Request $request)
    {
        // Validate the notification request
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'request_id' => 'required|exists:requests,id',
            'message' => 'required|string',
        ]);

        // Create a new notification
        $notification = Notification::create($data);

        return response()->json([
            'message' => 'Notification sent successfully',
            'notification' => $notification
        ], 201);
    }
}
