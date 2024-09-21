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

    public function getListFromThreeTables($tableName1, $tableName2, $tableName3, $columnIdFK1, $columnIdFK2, $condition = '')
    {
        $this->connectIfNeeded();

        $query = "SELECT * FROM $tableName1
        INNER JOIN $tableName2 ON $tableName1.$columnIdFK1 = $tableName2.$columnIdFK1
        INNER JOIN $tableName3 ON $tableName2.$columnIdFK2 = $tableName3.$columnIdFK2 $condition";

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

    public function getListFromTwoTables($tableName1, $tableName2, $columnIdFK, $condition = '')
    {
        $this->connectIfNeeded();

        $query = "SELECT * FROM $tableName1
        INNER JOIN $tableName2 ON $tableName1.$columnIdFK = $tableName2.$columnIdFK $condition";

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


    public function updateData($tableName, $updates, $condition = '')
    {
        $this->connectIfNeeded();
        $setUpdate = [];
        foreach ($updates as $column => $value) {
            $setUpdate[] = "`$column` = '$value'";
        }
        $set = implode(", ", $setUpdate);
        $update = "UPDATE `$tableName` SET $set $condition";
        return mysqli_query($this->connection, $update);
    }

    public function deleteData($tableName, $condition)
    {
        $this->connectIfNeeded();
        $delete = "DELETE FROM `$tableName` $condition;";
        return mysqli_query($this->connection, $delete);
    }

    public function __destruct()
    {
        $this->close();
    }
}
