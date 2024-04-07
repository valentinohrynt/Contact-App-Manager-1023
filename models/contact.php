<?php
require_once __DIR__ . '/../app/config/db_connect.php';

class Contact {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllContacts($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $contacts = array();
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
        return $contacts;
    }    
    
    public function createContact($contactName, $phone, $userId) {
        $stmt = $this->conn->prepare("INSERT INTO contacts (contact_name, phone, user_id, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("ssi", $contactName, $phone, $userId);
        $stmt->execute();
        return $this->conn->insert_id;
    }

    public function getContactById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateContact($id, $contactName, $phone, $userId) {
        $stmt = $this->conn->prepare("UPDATE contacts SET contact_name = ?, phone = ?, user_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $contactName, $phone, $userId, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function deleteContact($id) {
        $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}

$contactModel = new Contact($conn);
?>
