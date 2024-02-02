<?php

class Configuration
{
    public   $host = "localhost";
    public   $databaseName = "blog_post";
    public   $username = "root";
    public   $password = "jesuismysql";

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
