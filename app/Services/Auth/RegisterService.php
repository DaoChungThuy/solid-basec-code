<?php

namespace App\Services\Auth;

use App\Services\User\CreateUserService;
use Exception;
use Illuminate\Support\Facades\Log;

class RegisterService extends CreateUserService
{
    public function handle()
    {
        try {
            $user = parent::handle();

            return $user;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}