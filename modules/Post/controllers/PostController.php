<?php

namespace modules\Post\controllers;

use core\Controller;
use modules\Post\models\PostModel;

class PostController extends Controller
{
    public function index(): void
    {
        $postModel = new PostModel();
        $posts = $postModel->getPosts();
        $this->view('Post/index', ['posts' => $posts]);
    }
}