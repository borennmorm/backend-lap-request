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

        // Get all notifications for the user
        $notifications = Notification::where('user_id', $user->id)->get();

        return response()->json($notifications);
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
