<?php

namespace App\Controllers\Auth;

class LoginController
{
    public function __construct()
    {
    }

    public function login()
    {
        return view('auth.login');
    }
}