<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

use core\Router;

$url = $_GET['url'] ?? 'Post/post/index';
$router = new Router();
$router->route($url);