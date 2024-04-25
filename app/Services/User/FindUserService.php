<?php

namespace App\Services\User;

use App\Interfaces\User\UserRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class FindUserService extends BaseService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle()
    {
        try {
            $user = $this->userRepository->findBydata('id', $this->data);

            return $user;
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}
