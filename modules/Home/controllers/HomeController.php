<?php

namespace modules\Home\controllers;

use core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('Home/index', []);
    }
}