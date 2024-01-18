<?php

namespace modules\User\controllers;

use core\Controller;

class UserController extends Controller
{
    /**
     * @return void
     */
    public function showLoginForm(): void
    {
        $this->view('User/index');
    }

    /**
     * @return void
     */
    public function doLogin(): void
    {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        if ($this->login($username, $password)) {
            // Login bem-sucedido
            header('Location: /admin');
            exit;
        } else {
            // Falha no login
            // Renderize a view de login novamente com uma mensagem de erro
            $this->view('User/index', ['error' => 'Login falhou.']);
        }
    }

    public function showRegisterForm(): void {
        $this->view('User/register');
    }

    public function doRegister(): void {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $password_confirm = $_POST['password_confirm'] ?? null;

        if ($password !== $password_confirm) {
            // As senhas não coincidem
            $this->view('User/register', ['error' => 'As senhas não coincidem.']);
            return;
        }

        if ($this->auth->register($username, $password)) {
            // Registro bem-sucedido, redirecione para a página de login
            header('Location: /login');
            exit;
        } else {
            // Falha no registro
            $this->view('User/register', ['error' => 'Falha ao registrar o usuário.']);
        }
    }

    /**
     * @return void
     */
    public function doLogout(): void
    {
        $this->logout();
    }
}