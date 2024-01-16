<?php

namespace modules\Admin\controllers;

use core\Controller;

class AdminController extends Controller
{
    public function index(): void
    {
        $this->view('Admin/index');
    }
}