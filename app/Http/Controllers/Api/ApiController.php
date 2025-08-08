<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully.',
            'data' => $user,
        ], 201);
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful.',
                'data' => [
                    'user' => $user,
                    'token' => $user->createToken('API Token')->plainTextToken,
                ],
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials.',
        ], 401);
    }

    public function logout()
    {
        request()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logout successful.',
        ], 200);
    }

    public function user(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'user' => $request->user(),
        ], 200);
    }

    public function profile()
    {
        return response()->json([
            'status' => 'success',
            'user' => auth()->user(),
        ], 200);
    }

    public function refreshToken()
    {
        $token = request()->user()->createToken('API Token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Token refreshed successfully.',
            'user' => auth()->user(),
            'token' => $token,
        ], 200);
    }
}
