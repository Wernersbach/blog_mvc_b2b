<?php

namespace core;

class Router
{
    /**
     * @throws \Exception
     */
    public function route($url): void
    {
        $url = explode('/', $url);
        $moduleName = ucfirst($url[0]); // Certifique-se de que está em PascalCase
        $controllerName = ucfirst($url[1]); // Deve ser PascalCase também
        $actionName = $url[2]; // Os nomes de métodos são case-sensitive, então mantenha como está na definição do método

        // Ajuste o namespace para corresponder à sua estrutura de diretórios e padrão PSR-4
        $controllerClass = "modules\\$moduleName\\controllers\\${controllerName}Controller";

        // Certifique-se de que a classe existe antes de tentar instanciá-la
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            // Verifique se o método (ação) existe antes de chamá-lo
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                // Tratar o erro de método não encontrado
                throw new \Exception("Method $actionName not found in $controllerClass");
            }
        } else {
            // Tratar o erro de classe não encontrada
            throw new \Exception("Controller class $controllerClass not found");
        }
    }
}