<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as LabRequest; // To avoid naming conflicts with HTTP request

class RequestController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data, including additional fields
        $validatedData = $request->validate([
            'lab_id' => 'required|exists:labs,id',
            'study_time_id' => 'required|exists:study_times,id',
            'user_id' => 'required|exists:users,id',
            'request_date' => 'required|date',
            'major' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
            'generation' => 'required|string|max:50',
            'software_need' => 'nullable|string',
            'number_of_student' => 'required|integer',
            'additional' => 'nullable|string',
        ]);

        // Create a new request with validated data
        $newRequest = LabRequest::create($validatedData);

        return response()->json($newRequest, 201);
    }

    public function index()
    {
        // Return all requests with related models (lab, studyTime, user)
        return LabRequest::with(['lab', 'studyTime', 'user'])->get();
    }

    public function show($id)
    {
        // Find and return a specific request with related models
        $request = LabRequest::with(['lab', 'studyTime', 'user'])->findOrFail($id);
        return response()->json($request);
    }

    public function destroy($id)
    {
        // Find and delete a request
        $request = LabRequest::findOrFail($id);
        $request->delete();

        return response()->json(null, 204);
    }
}
