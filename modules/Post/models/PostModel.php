<?php

namespace modules\Post\models;

use core\Model;
use PDO;

class PostModel extends Model
{
    public function getPosts(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM posts");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}