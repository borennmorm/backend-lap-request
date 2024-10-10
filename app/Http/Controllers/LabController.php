<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Get a list of all labs.
     */
    public function index()
    {
        $labs = Lab::all();
        return response()->json($labs);
    }

    /**
     * Store a new lab.
     */
    public function store(Request $request)
    {
        // Validate input
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'building' => 'nullable|string|max:50',
            'lab_status' => 'required|boolean',
        ]);

        // Create new lab
        $lab = Lab::create($data);

        return response()->json(['message' => 'Lab created successfully', 'lab' => $lab], 201);
    }

    /**
     * Show a specific lab.
     */
    public function show($id)
    {
        $lab = Lab::findOrFail($id);
        return response()->json($lab);
    }

    /**
     * Update a specific lab.
     */
    public function update(Request $request, $id)
    {
        // Validate input
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'building' => 'nullable|string|max:50',
            'lab_status' => 'required|boolean',
        ]);

        $lab = Lab::findOrFail($id);
        $lab->update($data);

        return response()->json(['message' => 'Lab updated successfully', 'lab' => $lab]);
    }

    /**
     * Delete a specific lab.
     */
    public function destroy($id)
    {
        $lab = Lab::findOrFail($id);
        $lab->delete();

        return response()->json(['message' => 'Lab deleted successfully'], 204);
    }
}
