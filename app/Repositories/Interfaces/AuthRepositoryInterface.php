<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function Register(Array $data);
    public function Login(Array $credentials);
    public function logout();
}
