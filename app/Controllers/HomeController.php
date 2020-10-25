<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\ExampleServiceInterface;
use Core\Response;

class HomeController extends Response
{
    public function index(User $user, ExampleServiceInterface $exampleService)
    {
        return view('home', [
            'users' => $user->get(),
            'example' => $exampleService->getMessage()
        ]);
    }

    public function example()
    {
        return view('example');
    }
}