<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\StudyTimeApproval;
use App\Models\Notification;
use Illuminate\Http\Request as HttpRequest;

class ApprovalController extends Controller
{
    /**
     * Approve or reject study times for a lab request.
     */
    public function approve(HttpRequest $request, $id)
    {
        // Validate the incoming approval request
        $data = $request->validate([
            'study_times' => 'required|array',
            'study_times.*.study_time_id' => 'required|exists:study_times,id',
            'study_times.*.is_approved' => 'required|boolean',
        ]);

        // Find the lab request
        $labRequest = Request::findOrFail($id);

        // Loop through each study time and approve/reject them individually
        foreach ($data['study_times'] as $studyTimeApprovalData) {
            $studyTimeApproval = StudyTimeApproval::updateOrCreate(
                [
                    'request_id' => $labRequest->id,
                    'study_time_id' => $studyTimeApprovalData['study_time_id']
                ],
                [
                    'is_approved' => $studyTimeApprovalData['is_approved']   
                ]
            );

            // Prepare a notification message for each study time approval/rejection
            $message = $studyTimeApprovalData['is_approved']
                ? "Your lab request for study time ID {$studyTimeApprovalData['study_time_id']} has been approved."
                : "Your lab request for study time ID {$studyTimeApprovalData['study_time_id']} has been rejected.";

            Notification::create([
                'user_id' => $labRequest->user_id,
                'request_id' => $labRequest->id,
                'message' => $message,
            ]);

        }

        return response()->json([
            'message' => 'Study times have been reviewed.',
        ], 200);
    }
}
