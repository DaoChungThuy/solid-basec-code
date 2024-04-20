<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();
        if (!$validatedData) {
            return response()->json(['error' => 'Invalid data'], 422);
        }
        $user = resolve(LoginService::class)->setParams($request->all())->handle();
        if ($user) {
            return response()->json(['success' => true, 'message' => "Successful login"], 200);
        }
        return response()->json(['error' => 'Account or password is incorrect'], 401);
    }
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        if (!$validatedData) {
            return response()->json(['error' => 'Invalid data'], 422);
        }
        $user = resolve(RegisterService::class)->setParams($request->all())->handle();
        if ($user) {
            return response()->json(['success' => true, 'message' => "Sign Up Success"], 200);
        } else {
            return response()->json(['error' => 'An error occurred during registration'], 500);
        }
    }
}