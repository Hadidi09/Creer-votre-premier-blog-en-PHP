<?php

namespace App\Models;



class Configuration
{
    public $host;
    public $databaseName;
    public $username;
    public $password;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->databaseName = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getDatabaseName()
    {
        return $this->databaseName;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
