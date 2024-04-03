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
            $stmt->bindParam(":$key", $record[$key]);
        }

        return $stmt->execute();
    }

    #Update data into database
    public function update(string $table, array $record, int $id, string $idName): bool
    {
        $keys = array_keys($record);
        $param_arr = array_map(fn ($key) => ("$key = :$key"), $keys);
        $param_str = join(", ", $param_arr);

        $sql = "UPDATE $table SET $param_str WHERE $idName = :id";

        $stmt = $this->pdo->prepare($sql);

        foreach ($keys as $key) {
            $stmt->bindParam(":$key", $record[$key]);
        }

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    #Find data in database
    public static function find(string $prop, string|int $value, string $tableName): array|bool
    {
        $sql = "SELECT * FROM $tableName WHERE  $prop = :$prop";

        $model = new Model();
        $stmt = $model->getPDO()->prepare($sql);
        $stmt->execute([":$prop" => $value]);

        return $stmt->fetch();
    }

    public function all(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function delete(string $idName, int $id, string $tableName): bool
    {
        $sql = "DELETE FROM $tableName WHERE $idName = :$idName";

        $model = new Model();
        $stmt = $model->getPDO()->prepare($sql);
        return $stmt->execute([
            ":$idName" => $id
        ]);
    }

    #Get 1 column value
    public static function findByProp(string $tableName, string $property, string|int $value)
    {
        $Model = new Model();
        $sql = "SELECT $property FROM $tableName WHERE $property = :$property";
        $stmt = $Model->getPDO()->prepare($sql);
        $stmt->bindValue(":$property", $value);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    #Find by search key
    public static function findByKeys(string $key, string $tableName, array $props)
    {
        $number_prop = count($props);
        $sql = '';
        $i = 0;
        do {
            $param = $props[$i];
            if ($i === 0) {
                $sql = "SELECT * FROM $tableName WHERE  $param LIKE :$param";
            } else {
                $sql .= " or $param LIKE :$param";
                $number_prop--;
            }
            $i++;
        } while ($number_prop > 1);

        $model = new Model();
        $stmt = $model->getPDO()->prepare($sql);

        $var = "%$key%";
        foreach ($props as $prop) {
            $stmt->bindParam(":$prop", $var);
        }
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
