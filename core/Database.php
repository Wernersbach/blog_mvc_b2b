<?php

namespace core;

use PDO;

class Database
{
    public static function getConnection(): PDO
    {
        // Aqui você coloca os detalhes da sua conexão
        $host = 'db';
        $db = 'blog';
        $user = 'root';
        $pass = 'secret';
        $charset = 'utf8mb4';

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            return new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}