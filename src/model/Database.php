<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//require_once('./src/model/Configuration.php');
require(dirname(__FILE__) . '/../model/Configuration.php');

class Database extends PDO
{

    public $config;



    private $connection;


    public function __construct()
    {
        $this->config = new Configuration();
        $dsn = "mysql:host={$this->config->getHost()};dbname={$this->config->getDatabaseName()}";
        var_dump($dsn);
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
