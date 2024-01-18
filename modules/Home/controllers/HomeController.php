<?php

namespace modules\Home\controllers;

use core\Controller;
use modules\Post\models\PostModel;

class HomeController extends Controller
{
    public function index(): void
    {
        $postModel = new PostModel();
        $posts = $postModel->getPosts();

        $this->view('Home/index', ['posts' => $posts]);
    }
}