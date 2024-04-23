<?php

namespace App\Models;

use PDO;
use PDOException;

error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\Models\Configuration;


class Database extends PDO
{

    public $config;



    private $connection;


    public function __construct()
    {
        $this->config = new Configuration();
        $dsn = "mysql:host={$this->config->getHost()};dbname={$this->config->getDatabaseName()}";
        try {
            $this->connection = new PDO($dsn, $this->config->getUsername(), $this->config->getPassword());
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Echec de la connexion :" . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
