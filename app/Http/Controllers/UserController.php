<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;




class UserController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'gender' => 'required|string|max:20',
                'phone' => 'nullable|string|max:15',
                'department' => 'nullable|string|max:100',
                'faculty' => 'nullable|string|max:100',
                'position' => 'nullable|string|max:50',
                'image' => 'nullable|string',
            ]);

            // Create the new user
            $user = User::create([
                'role' => 'user',
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'gender' => $validatedData['gender'],
                'phone' => $validatedData['phone'] ?? null,
                'department' => $validatedData['department'] ?? null,
                'faculty' => $validatedData['faculty'] ?? null,
                'position' => $validatedData['position'] ?? null,
                'image' => $validatedData['image'] ?? null,
                'email_verified_at' => now(),
            ]);

            // Check if the user was successfully created
            if (!$user) {
                return response()->json(['message' => 'User registration failed'], 500);
            }

            // Create and return access token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], Response::HTTP_CREATED); // Use Symfony's Response constant for clarity

        } catch (ValidationException $e) {
            // Return validation error messages with 422 status code
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Log the error and return a 500 response for any other exceptions
            \Log::error('User registration error: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred during registration'], 500);
        }
    }

    /**
     * Login an existing user.
     */
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate user
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401); // Unauthorized error
        }

        // Fetch the authenticated user
        $user = User::where('email', $request->email)->firstOrFail();

        // Create and return access token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    public function getProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if the image is a full URL or a stored file
        $imageUrl = filter_var($user->image, FILTER_VALIDATE_URL)
                    ? $user->image
                    : ($user->image ? asset('storage/app/public/images/user_profile.png' . $user->image) : null);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'department' => $user->department,
            'faculty' => $user->faculty,
            'position' => $user->position,
            'image' => $imageUrl,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], 200);
    }


    /**
     * Update the authenticated user's profile image.
     */
    public function updateProfileImage(Request $request)
    {
        // Validate the image upload
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . md5($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();

            // Use storage instead of moving directly to public
            $imagePath = $image->storeAs('profiles', $imageName, 'public');

            // Delete the old image if exists
            if ($user->image) {
                Storage::disk('public')->delete('profiles/' . $user->image);
            }

            // Update the user record with the new image
            $user->image = $imageName;
            $user->save();

            return response()->json([
                'message' => 'Profile image updated successfully',
                'image' => $imageName,
            ], 200);
        }

        return response()->json(['message' => 'No image uploaded'], 400);
    }
}

