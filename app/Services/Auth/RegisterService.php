<?php

namespace App\Services\Auth;

use App\Services\User\CreateUserService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class RegisterService extends CreateUserService
{
    public function handle()
    {
        try {
            $this->data['password'] = Hash::make($this->data['password']);

            $user = parent::handle();

            return $user;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}