<?php

class Model extends Database
{
    public function __construct()
    {
        $this->connectIfNeeded();
    }

    private function connectIfNeeded()
    {
        if (!$this->connection) {
            $this->connect();
        }
    }

    public function getListTable($tableName, $condition = '')
    {
        $this->connectIfNeeded();

        $query = "SELECT * FROM `$tableName` $condition";
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($this->connection));
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        mysqli_free_result($result);
        return $data;
    }

    public function insertData($tableName, $data)
    {
        $this->connectIfNeeded();

        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_values($data));
        $insert = "INSERT INTO `$tableName` ($columns) VALUES('$values')";

        return mysqli_query($this->connection, $insert);
    }

    public function __destruct()
    {
        $this->close();
    }
}
