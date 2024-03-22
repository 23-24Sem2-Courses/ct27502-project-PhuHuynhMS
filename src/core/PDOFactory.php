<?php

namespace App\Core;

use PDO;
use PDOException;

class PDOFactory
{
    private $dbhost, $dbname, $dbuser, $dbpass;

    public function __construct(array $config)
    {
        $this->dbhost = $config['dbhost'];
        $this->dbname = $config['dbname'];
        $this->dbuser = $config['dbuser'];
        $this->dbpass = $config['dbpass'];
    }

    public function connect(): PDO
    {
        try {
            $dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname . ';charset=utf8mb4';
            $optional = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];

            return new PDO($dsn, $this->dbuser, $this->dbpass, $optional);
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
