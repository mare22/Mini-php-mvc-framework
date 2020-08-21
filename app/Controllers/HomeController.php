<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\ExampleServiceInterface;
use Core\Response;

class HomeController extends Response
{
    public function index(User $user, ExampleServiceInterface $exampleService)
    {
        $data = [
            'users' => $user->get(),
            'example' => $exampleService->exampleBusinessLogic()
        ];

        $this->view('home', $data);
    }
}