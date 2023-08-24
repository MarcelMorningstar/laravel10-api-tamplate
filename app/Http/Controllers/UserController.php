<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request): Response
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        $token = $user->createToken($user->name)->plainTextToken;

        return response(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request): Response
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Unauthorized'], 401);
        }

        $token = $user->createToken($user->name)->plainTextToken;

        return response(['user' => $user, 'token' => $token], 201);
    }

    public function logout(Request $request) : Response {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged out']);
    }
}
