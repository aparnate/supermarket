<?php

require_once(dirname(__DIR__).'/includes/DBConnection.php');

class Queries extends DBConnection
{
    public function getResult(string $query): array
    {
        $records = [];
        $result = mysqli_query($this->connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }
        return $records;
    }


    public function getCount(string $query): string|int
    {
        $result = mysqli_query($this->connection, $query);
        return mysqli_num_rows($result);
    }

    public function getSingleRecord(string $query)
    {
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_assoc($result);
    }


    public function __destruct()
    {
        $this->connection->close();
    }
}