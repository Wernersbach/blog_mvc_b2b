<?php

namespace modules\Admin\models;

use core\Model;

class PostModel extends Model
{
    /**
     * @return bool|array
     */
    public function getAllPosts(): bool|array
    {
        $stmt = $this->db->query("SELECT * FROM posts");
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * @param $user_id
     * @param $title
     * @param $content
     * @return bool|string
     */
    public function createPost($user_id, $title, $content): bool|string
    {
        $stmt = $this->db->prepare("INSERT INTO posts (user_id, title, content) VALUES (:user_id, :title, :content)");
        $stmt->execute([
            'user_id' => $user_id,
            'title'   => $title,
            'content' => $content
        ]);
        return $this->db->lastInsertId();
    }

    /**
     * @param $id
     * @param $user_id
     * @param $title
     * @param $content
     * @return int
     */
    public function updatePost($id, $user_id, $title, $content): int
    {
        $stmt = $this->db->prepare("UPDATE posts SET user_id = :user_id, title = :title, content = :content WHERE id = :id");
        $stmt->execute([
            'id'      => $id,
            'user_id' => $user_id,
            'title'   => $title,
            'content' => $content
        ]);
        return $stmt->rowCount();
    }

    /**
     * @param $id
     * @return int
     */
    public function deletePost($id): int
    {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}