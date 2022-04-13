<?php


class DBConnection
{
    public mysqli|NUll $connection;
    private string $hostname = 'localhost';
    private string $userName = 'root';
    private string $password = 'root';
    private string $databaseName = 'supermarket';

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        $this->connection = new mysqli($this->hostname, $this->userName, $this->password, $this->databaseName);
        if ($this->connection->connect_errno) {
            echo "Failed to connect to MySQL: ".$this->connection->connect_error;

            exit();
        }
    }

    public function disconnect(): void
    {
        $this->connection->close();
    }

}