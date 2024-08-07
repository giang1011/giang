<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find the user by username
        $user = User::where('username', $request->username)->first();

        // Check if user exists
        if (!$user) {
            Log::error('Login failed: User not found', ['username' => $request->username]);
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Check if the password is correct
        if (!Hash::check($request->password, $user->password)) {
            Log::error('Login failed: Incorrect password', ['username' => $request->username]);
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        

        // Successful login
        Log::info('Login successful', ['username' => $request->username]);
        return response()->json(['message' => 'Login successful'], 200);
    }
}
