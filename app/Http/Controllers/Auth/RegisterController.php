<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\User\CreateUserService;
use App\Http\Requests\Auth\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /**
     * Handle a registration request.
     *
     * @param  RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($request->password);
        $user = resolve(CreateUserService::class)->setParams($validatedData)->handle();

        if ($user) {
            return response()->json(['success' => true, 'message' => __('auth.register_success')], Response::HTTP_OK);
        }

        return response()->json(['error' => __('auth.registration_error')], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
