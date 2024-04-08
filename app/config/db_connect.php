<?php
class DbConnect {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_contactappmanager";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
$db = new DbConnect();
$conn = $db->getConnection();