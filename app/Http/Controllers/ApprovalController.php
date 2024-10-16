<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Approval;
use App\Models\Notification;
use Illuminate\Http\Request as HttpRequest;

class ApprovalController extends Controller
{
    /**
     * Approve or reject a lab request and notify the user.
     */
    public function approve(HttpRequest $request, $id)
    {
        // Validate the approval request
        $data = $request->validate([
            'is_approve' => 'required|boolean',
        ]);

        // Find the lab request
        $labRequest = Request::findOrFail($id);

        // Check if the request has already been approved
        $existingApproval = Approval::where('request_id', $labRequest->id)->first();
        if ($existingApproval) {
            return response()->json(['message' => 'This request has already been reviewed'], 400);
        }

        // Create a new approval record
        $approval = new Approval();
        $approval->request_id = $labRequest->id;
        $approval->is_approve = $data['is_approve'];
        $approval->save();

        // Send notification to the user about the approval/rejection
        $message = $approval->is_approve
            ? 'Your lab request has been approved.'
            : 'Your lab request has been rejected.';

        // Create a notification for the user
        Notification::create([
            'user_id' => $labRequest->user_id,  // Assuming user_id is associated with the request
            'message' => $message,
        ]);

        return response()->json([
            'message' => 'Request has been ' . ($approval->is_approve ? 'approved' : 'rejected'),
            'approval' => $approval
        ], 200);
    }
}
