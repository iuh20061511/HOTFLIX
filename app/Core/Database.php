<?php

class Database
{
    protected $connection;

    public function connect()
    {
        if (!$this->connection) {
            $this->connection = mysqli_connect('localhost', 'root', '', 'hotflix');

            if (!$this->connection) {
                die('Connection failed: ' . mysqli_connect_error());
            }

            mysqli_set_charset($this->connection, "utf8");
        }

        return $this->connection;
    }

    public function close()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
            $this->connection = null; // Đặt biến kết nối về null
        }
    }
}

?>