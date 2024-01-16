<?php

require_once 'vendor/autoload.php';

use Core\Router;

$url = $_GET['url'] ?? 'Post/post/index';
$router = new Router();
$router->route($url);