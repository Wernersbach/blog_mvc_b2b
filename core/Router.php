<?php

namespace core;

use Exception;

class Router
{

    /**
     * @var array|array[]
     */
    private array $routes;

    public function __construct()
    {
        $this->routes = [
            'home' => ['controller' => 'Home', 'action' => 'index'],
            'post' => ['controller' => 'Post', 'action' => 'index'],
            'admin' => ['controller' => 'Admin', 'action' => 'index']
        ];
    }

    /**
     * @param $url
     * @return void
     * @throws Exception
     */
    public function route($url): void
    {
        $url = explode('/', $url);
        $route = $url[0];

        if (array_key_exists($route, $this->routes)) {
            $controllerName = $this->routes[$route]['controller'];
            $actionName = $this->routes[$route]['action'];
        } else {
            // Rota padrão ou página 404
            $controllerName = 'Home';
            $actionName = 'index';
        }

        $controllerClass = "modules\\$controllerName\\controllers\\{$controllerName}Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                throw new \Exception("Action $actionName not found in $controllerClass");
            }
        } else {
            throw new \Exception("Controller class $controllerClass not found");
        }
    }
}