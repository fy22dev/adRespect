<?php
declare(strict_types=1);

namespace Core;

use Exception;
use PDO;
use PDOException;

class Db
{
    private PDO $pdo;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $configPath = __DIR__ . '/../app/config/database.php';
        if (!file_exists($configPath)) {
            throw new Exception(sprintf('Database config file not found (%s)', $configPath));
        }

        $config = require_once($configPath);

        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO($dsn, $config['user'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new PDOException('Database error: ' . $e->getMessage(), (int)$e->getCode());
        }
    }

    public function __call($name, $arguments)
    {
        return call_user_func([$this->pdo, $name], ...$arguments);
    }
}
