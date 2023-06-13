<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

/**
 * Class Database
 *
 * @package App\Core
 */
class Database
{
    public PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:host=localhost;dbname=mvc.local', 'root', 'fenix13071706');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function selectWhereFirst(string $table, string $name, string $value): array
    {
        $sql = "SELECT * FROM $table where $name = :value";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['value' => $value]);

        foreach ($stmt as $row) {
            return $row;
        }

        return [];
    }

    public function create(string $table, array $data): bool
    {
        $keys = \array_keys($data);
        $fields = implode(',', $keys);

        $placeholders = [];
        foreach ($keys as $column) {
            $placeholders[] = ':' . $column;
        }

        $placeholders = \implode(',', $placeholders);

        $sql = "INSERT into $table ($fields) values ($placeholders)";

        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute($data);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }

        return true;
    }
}
