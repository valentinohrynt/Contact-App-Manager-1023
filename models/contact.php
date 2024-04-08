<?php
require_once __DIR__ . '/../app/config/db_connect.php';

class Contact {
    public static function getAllContacts($conn, $userId) {
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $contacts = array();
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
        return $contacts;
    }    
    
    public static function createContact($conn, $contactName, $phone, $userId) {
        $stmt = $conn->prepare("INSERT INTO contacts (contact_name, phone, user_id, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("ssi", $contactName, $phone, $userId);
        $stmt->execute();
        return $conn->insert_id;
    }

    public static function getContactById($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function updateContact($conn, $id, $contactName, $phone, $userId) {
        $stmt = $conn->prepare("UPDATE contacts SET contact_name = ?, phone = ?, user_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $contactName, $phone, $userId, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public static function deleteContact($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}

// $contactModel = new Contact($conn);
?>
