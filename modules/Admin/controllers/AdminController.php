<?php

namespace modules\Admin\controllers;

use core\Controller;
use core\Database;
use modules\Admin\models\PostModel;
use modules\Admin\models\UserModel;
use PDO;

class AdminController extends Controller
{
    private PDO $db;
    private UserModel $userModel;
    private PostModel $postModel;

    public function __construct() {
        $this->db = Database::getConnection();
        $this->userModel = new UserModel($this->db);
        $this->postModel = new PostModel($this->db);
    }

    public function index() {
        try {
            $users = $this->userModel->getAllUsers();
            $posts = $this->postModel->getAllPosts();
            $this->view('Admin/index', ['users' => $users, 'posts' => $posts]);
        } catch (PDOException $e) {
            // Lida com o erro aqui
            die("Ocorreu um erro na base de dados: " . $e->getMessage());
        }
    }

    public function backupDatabase(): void
    {
        // Verifique as permissões aqui...

        // Defina o nome do arquivo de backup
        $dumpFileName = 'backup-' . date('Y-m-d') . '.sql';
        // Defina o caminho temporário para o arquivo de backup no servidor
        $tempPath = sys_get_temp_dir() . '/' . $dumpFileName;
        // Comando para gerar o backup
        $command = "mysqldump -u root -psecret blog > " . escapeshellarg($tempPath);

        system($command, $output);

        // Verifique o sucesso do comando
        if ($output === 0) {
            // Envie o arquivo para o navegador
            $this->downloadFile($tempPath);
            // Após enviar o arquivo, exclua-o
            unlink($tempPath);
        } else {
            echo 'Falha ao realizar o backup do banco de dados.';
        }
    }

    private function downloadFile($filePath): void
    {
        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            flush();
            readfile($filePath);
            exit;
        } else {
            echo 'Arquivo de backup não encontrado.';
        }
    }
}