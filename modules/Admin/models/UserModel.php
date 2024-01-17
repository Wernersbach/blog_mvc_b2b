<?php

namespace modules\Admin\models;

use core\Model;

class UserModel extends Model
{
    protected \PDO $db;

    public function getAllUsers(): bool|array
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function createUser($username, $password, $role_id): bool|string
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role_id) VALUES (:username, :password, :role_id)");
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([
            'username' => $username,
            'password' => $passwordHash,
            'role_id'  => $role_id
        ]);
        return $this->db->lastInsertId();
    }

    public function updateUser($id, $username, $password, $role_id): int
    {
        $stmt = $this->db->prepare("UPDATE users SET username = :username, password = :password, role_id = :role_id WHERE id = :id");
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([
            'id'       => $id,
            'username' => $username,
            'password' => $passwordHash,
            'role_id'  => $role_id
        ]);
        return $stmt->rowCount();
    }

    public function deleteUser($id): int
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}