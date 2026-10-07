<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = strtolower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return response()->json(['message' => 'Too many login attempts. Please try again later.'], 429);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::clear($throttleKey);
            LogService::log(Auth::id(), 'User logged in');
            return response()->json(['message' => 'Login successful']);
        } else {
            RateLimiter::hit($throttleKey, 60); // Lockout for 60 seconds
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}
