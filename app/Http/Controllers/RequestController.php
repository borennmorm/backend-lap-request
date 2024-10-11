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
            'study_time_id' => 'required|array', // Accept an array of study_time_id
            'study_time_id.*' => 'exists:study_times,id', // Validate each study_time_id
            'user_id' => 'required|exists:users,id',
            'request_date' => 'required|date',
            'major' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
            'generation' => 'required|string|max:50',
            'software_need' => 'nullable|string',
            'number_of_student' => 'required|integer',
            'additional' => 'nullable|string',
        ]);

        // Create a new request with the validated data (excluding study_time_id for now)
        $newRequest = LabRequest::create([
            'lab_id' => $validatedData['lab_id'],
            'user_id' => $validatedData['user_id'],
            'request_date' => $validatedData['request_date'],
            'major' => $validatedData['major'],
            'subject' => $validatedData['subject'],
            'generation' => $validatedData['generation'],
            'software_need' => $validatedData['software_need'],
            'number_of_student' => $validatedData['number_of_student'],
            'additional' => $validatedData['additional'],
        ]);

        // Attach multiple study times to the request using a many-to-many relationship
        $newRequest->studyTimes()->attach($validatedData['study_time_id']);

        return response()->json($newRequest->load('studyTimes'), 201); // Return request with studyTimes relationship loaded
    }

    public function index()
    {
        // Return all requests with related models (lab, studyTimes, user)
        return LabRequest::with(['lab', 'studyTimes', 'user'])->get();
    }

    public function show($id)
    {
        // Find and return a specific request with related models
        $request = LabRequest::with(['lab', 'studyTimes', 'user'])->findOrFail($id);
        return response()->json($request);
    }

    public function destroy($id)
    {
        // Find and delete a request
        $request = LabRequest::findOrFail($id);
        $request->studyTimes()->detach(); // Detach all related study times
        $request->delete();

        return response()->json(null, 204);
    }
}
