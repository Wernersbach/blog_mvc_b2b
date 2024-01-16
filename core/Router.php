<?php

namespace core;

class Router
{
    public function route($url)
    {
        $url = explode('/', $url);
        $moduleName = $url[0];
        $controllerName = ucfirst(strtolower($url[1]));
        $actionName = strtolower($url[2]);

        $controllerClass = "Module\\$moduleName\\Controllers\\${controllerName}Controller";
        $controller = new $controllerClass();
        $controller->$actionName();
    }
}