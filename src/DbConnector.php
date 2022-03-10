<?php
namespace DbConnector;
use \PDO as PDO;

use Contracts\DbType\DbType;

class DbConnector implements DbType
{
    private $dbInstance;

    public function __construct($config)
    {
        try {
            $this->dbInstance = new PDO($config['connectionString'], $config['user'], $config['password']);
            // set the PDO error mode to exception
            $this->dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function connect()
    {
        return $this->dbInstance;
    }
}