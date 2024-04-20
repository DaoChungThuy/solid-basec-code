<?php

namespace App\Repositories\Auth;

use App\Interfaces\AuthReponsitoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BaseRepository;
use App\Models\User;

class AuthRepository extends BaseRepository implements AuthReponsitoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function login(array $data)
    {
        if (Auth::attempt($data)) {
            return true;
        }
        return false;
    }
    public function logout()
    {
        Auth::logout();
    }
    public function register(array $data)
    {
        $this->create($data);
        return true;
    }
}