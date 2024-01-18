<?php

namespace core;

use Exception;

class Router
{

    /**
     * @var array|array[]
     */
    private array $routes;
    private Auth $auth;
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
        $this->auth = new Auth($this->db);
        $this->routes = [
            'home' => ['controller' => 'Home', 'action' => 'index'],
            'post' => ['controller' => 'Post', 'action' => 'index', 'auth' => true],
            'admin' => ['controller' => 'Admin', 'action' => 'index', 'auth' => true], // Requer autenticação
            'login' => ['controller' => 'User', 'action' => 'showLoginForm'],
            'login_post' => ['controller' => 'User', 'action' => 'doLogin', 'method' => 'POST'],
            'logout' => ['controller' => 'User', 'action' => 'doLogout'],
            'register' => ['controller' => 'User', 'action' => 'showRegisterForm'],
            'register_post' => ['controller' => 'User', 'action' => 'doRegister', 'method' => 'POST']

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
        $route = $url[0] ?: 'home'; // Rota padrão para 'home' se nenhuma for especificada

        if (array_key_exists($route, $this->routes)) {
            $controllerName = $this->routes[$route]['controller'];
            $actionName = $this->routes[$route]['action'];

            // Verifique se a rota requer autenticação
            if (!empty($this->routes[$route]['auth']) && $this->routes[$route]['auth'] && !$this->auth->check()) {
                header('Location: /login');
                exit;
            }

            if ($route === 'admin' && !$this->auth->isAdmin()) {
                header('Location: /post'); // Redireciona usuários não-admin para a página de post
                exit;
            }

            // Verifique se o método HTTP corresponde, se especificado
            if (!empty($this->routes[$route]['method']) && $_SERVER['REQUEST_METHOD'] !== $this->routes[$route]['method']) {
                throw new Exception("Metodo de rota incorreto $route");
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
        } else {
            // Rota padrão ou página 404
            // Aqui você pode direcionar para uma página de erro 404 personalizada
            header("HTTP/1.0 404 Not Found");
            // Inclua sua própria página 404 ou
            die("404 Not Found");
        }
    }
}