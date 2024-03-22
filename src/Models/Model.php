<?php

namespace App\Models;

use App\Core\PDOFactory;

use \PDO;

class Model
{
    private PDO $pdo;

    protected function __construct()
    {
        $config = [
            'dbhost' => $_ENV['DB_HOST'],
            'dbname' => $_ENV['DB_NAME'],
            'dbuser' => $_ENV['DB_USER'],
            'dbpass' => $_ENV['DB_PASS']
        ];
        $db = new PDOFactory($config);
		$this->pdo = $db->connect();
    }

    protected function getPDO(): PDO
    {
        return $this->pdo;
    }

    // save record into database
    public function save(string $table, array $record): bool
    {
        $keys = array_keys($record);
        $keys_str = join(", ", $keys);
        $param_arr = array_map(fn ($key) => (":$key"), $keys);
        $param_str = join(", ", $param_arr);

        $sql = "INSERT INTO $table ($keys_str) VALUES ($param_str)";

        $stmt = $this->pdo->prepare($sql);

        foreach ($keys as $key) {
            $stmt->bindParam(":$key", $record["$key"]);
        }

        return $stmt->execute();
    }

    #Update data into database
    public function update(string $table, array $record, int $id): bool
    {
        $keys = array_keys($record);
        $keys_str = join(", ", $keys);
        $param_arr = array_map(fn ($key) => ("$key = :$key"), $keys);
        $param_str = join(", ", $param_arr);

        $sql = "UPDATE $table SET $param_str WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        foreach ($keys as $key) {
            $stmt->bindParam(":$key", $record["$key"]);
        }

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    #Find data in database
    public function find(int $id, string $tableName)
    {
        $sql = "SELECT * FROM $tableName WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch();
    }

    public function all(string $tableName) : array
    {
        $sql = "SELECT * FROM $tableName";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete(int $id, string $tableName): bool
    {
        $sql = "DELETE FROM $tableName WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
