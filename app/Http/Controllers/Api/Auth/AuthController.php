<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegisterService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $result = resolve(RegisterService::class)->setParams($request->validated())->handle();

        if (!$result) {
            return $this->responseErrors(__('auth.registration_error'));
        }

        return $this->responseSuccess([
            'user' => $result,
            'message' => __('auth.register_success'),
        ]);
    }

    /**
     * Handle user login.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        if (!$token = auth()->attempt($validatedData)) {
            return $this->responseErrors(__('auth.failed'), Response::HTTP_UNAUTHORIZED);
        }

        $user = auth()->user();

        return $this->responseSuccess([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'message' => __('auth.login_success'),
        ]);
    }
}
