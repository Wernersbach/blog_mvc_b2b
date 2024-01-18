<?php

namespace core;

class Auth
{
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password): bool
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Debugging temporário
        error_log('Username: ' . $username);
        error_log('Password: ' . $password);
        error_log('Hash from DB: ' . ($user ? $user['password'] : 'User not found'));

        if ($user && password_verify($password, $user['password'])) {
            // Armazena o usuário na sessão
            $_SESSION['user_id'] = $user['id'];
            return true;
        }

        return false;
    }

    public function check(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function isAdmin(): bool {
        $user = $this->user();
        if ($user) {
            return $user['role_id'] == 2;
        }
        return false;
    }

    public function can($permissionName): bool
    {
        $user = $this->user();
        if (!$user) {
            return false;
        }

        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM role_permissions 
            INNER JOIN permissions ON role_permissions.permission_id = permissions.id 
            WHERE role_permissions.role_id = ? AND permissions.name = ?
        ");
        $stmt->execute([$user['role_id'], $permissionName]);
        return $stmt->fetchColumn() > 0;
    }

    public function user()
    {
        if ($this->check()) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            return $stmt->fetch();
        }

        return null;
    }

    public function register($username, $password): bool {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $defaultRoleId = $this->getDefaultRoleIdForNewUsers(); // Implemente este método para buscar o ID do papel padrão
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hash, $defaultRoleId]);
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
    }

    private function getDefaultRoleIdForNewUsers(): int
    {
        return 1; // ID do papel 'visitante'
    }
}