<?php

namespace core;

class Permission
{
    protected $db;
    protected $userId;
    protected $permissions;

    public function __construct($db, $userId) {
        $this->db = $db;
        $this->userId = $userId;
        $this->loadPermissions();
    }

    protected function loadPermissions(): void
    {
        // Carregar as permissões do usuário com base no role_id
        $sql = "SELECT p.name FROM permissions p 
                INNER JOIN role_permissions rp ON p.id = rp.permission_id 
                INNER JOIN users u ON rp.role_id = u.role_id 
                WHERE u.id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->userId]);

        $this->permissions = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function hasPermission($permission): bool
    {
        return in_array($permission, $this->permissions);
    }

}