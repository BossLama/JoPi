<?php

namespace JoPi\App;
class DatabaseConnector
{

    private array $config;
    private \PDO $connection;

    public function __construct(?array $config)
    {
        if($config == null) $this->config = Config::getDatabaseConf();
        else $this->config = $config;

        $this->connect();
    }

    // Connects to the database
    public function connect() : \PDO
    {
        $dsn = 'mysql:host=' . $this->config['host'] . ';dbname=' . $this->config['database'];
        $this->connection = new \PDO($dsn, $this->config['user'], $this->config['password']);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this->connection;
    }

    // Returns the connection
    public function getConnection() : \PDO
    {
        return $this->connection;
    }

}

?>