<?php

namespace App\Http\Controllers;

use App\Models\StudyTime;
use Illuminate\Http\Request;

class StudyTimeController extends Controller
{
    /**
     * Get all study time slots.
     */
    public function index()
    {
        $studyTimes = StudyTime::all();
        return response()->json($studyTimes);
    }

    /**
     * Store a new study time slot.
     */
    public function store(Request $request)
    {
        // Validate input
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'number' => 'required|string|max:50',
        ]);

        // Create new study time
        $studyTime = StudyTime::create($data);

        return response()->json(['message' => 'Study time created successfully', 'studyTime' => $studyTime], 201);
    }

    /**
     * Show a specific study time slot.
     */
    public function show($id)
    {
        $studyTime = StudyTime::findOrFail($id);
        return response()->json($studyTime);
    }

    /**
     * Update a specific study time slot.
     */
    public function update(Request $request, $id)
    {
        // Validate input
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'number' => 'required|string|max:50',
        ]);

        $studyTime = StudyTime::findOrFail($id);
        $studyTime->update($data);

        return response()->json(['message' => 'Study time updated successfully', 'studyTime' => $studyTime]);
    }

    /**
     * Delete a specific study time slot.
     */
    public function destroy($id)
    {
        $studyTime = StudyTime::findOrFail($id);
        $studyTime->delete();

        return response()->json(['message' => 'Study time deleted successfully'], 204);
    }
}

