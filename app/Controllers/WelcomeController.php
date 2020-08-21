<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\ExampleServiceInterface;
use Core\Response;

class WelcomeController extends Response
{
    protected $exampleService;

    public function __construct(ExampleServiceInterface $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    public function index()
    {
        return view('welcome');
    }
}