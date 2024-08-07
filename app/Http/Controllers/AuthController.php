<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['message' => 'Login successful', 'user' => $user]);
        }

        // Log lỗi khi thông tin đăng nhập không đúng
        Log::error('Login failed', ['username' => $request->username]);

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
