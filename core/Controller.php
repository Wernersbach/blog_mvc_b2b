<?php

namespace core;

class Controller
{
    /**
     * Método para instanciar um modelo
     *
     * @param $model
     * @return mixed
     */
    protected function model($model): mixed
    {
        require_once "module/" . str_replace("\\", "/", $model) . ".php";
        $model = "Modules\\" . $model;
        return new $model();
    }

    /**
     * Método para carregar uma visão (view)
     *
     * @param $view
     * @param array $data
     * @return void
     */
    protected function view($view, array $data = []): void {
        // Divida o caminho da view em partes para obter o nome do módulo e o caminho da view
        $viewParts = explode('/', $view);
        $moduleName = $viewParts[0];
        $viewPath = implode('/', array_slice($viewParts, 1));

        // Construa o caminho absoluto para a view
        $filePath = __DIR__ . "/../modules/{$moduleName}/views/{$viewPath}.php";

        // Verifique se o arquivo da view existe
        if (file_exists($filePath)) {
            // Extraia os dados para que possam ser usados como variáveis na view
            extract($data);

            // Inclua o arquivo da view
            require_once $filePath;
        } else {
            // Trate o erro de arquivo não encontrado
            die("View não existe: {$filePath}");
        }
    }

}