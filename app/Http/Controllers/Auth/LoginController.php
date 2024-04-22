<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::attempt($validatedData);

        if ($user) {
            return response()->json(['success' => true, 'message' => __('auth.login_success')], Response::HTTP_OK);
        }

        return response()->json(['error' => __('auth.password')], Response::HTTP_UNAUTHORIZED);
    }
}
