<?php
class DBcontroller
{

    private $host = 'Localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'magic_cake';
    private $conn;
    function __construct()
    {
        $this->conn = $this->connectDB();
    }
    function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
        return $conn;
    }
    function executequery($query)
    {
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    function runquery($query)
    {
        $result = $this->executequery($query);

        while ($row = mysqli_fetch_assoc($result)) {
            $row2[] = $row;
        }
        if (!empty($row2)) {
            return $row2;
        }
    }
    function numrows($query)
    {
        $result = $this->executequery($query);
        $count = mysqli_num_rows($result);
        return $count;
    }
    function fetchresult($query)
    {
        $result = $this->executequery($query);
        $fetch = mysqli_fetch_assoc($result);
        return $fetch;
    }
    function fetchall($query)
    {
        $result = $this->executequery($query);
        $fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $fetch;
        if (!empty($row2)) {
            return $row2;
        }
    }


    function secure($var)
    {
        $var1 = trim(mysqli_real_escape_string($this->conn, $var));
        return $var1;
    }
}
