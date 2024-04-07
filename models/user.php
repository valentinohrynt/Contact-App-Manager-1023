<?php
require_once __DIR__ . '/../app/config/db_connect.php';


class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUser($username, $passwordHash, $fullName, $phone, $email) {
        $stmt = $this->conn->prepare("INSERT INTO users (username, password, full_name, phone, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $passwordHash, $fullName, $phone, $email);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function getUserByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateUser($id, $username, $passwordHash, $fullName, $phone, $email) {
        $stmt = $this->conn->prepare("UPDATE users SET username = ?, password = ?, full_name = ?, phone = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $username, $passwordHash, $fullName, $phone, $email, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}

$userModel = new User($conn);
?>
