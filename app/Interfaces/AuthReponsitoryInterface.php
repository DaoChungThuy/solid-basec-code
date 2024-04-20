<?php

namespace App\Interfaces;

interface AuthReponsitoryInterface
{
    public function login(array $data);
    public function logout();
    public function register(array $data);
}