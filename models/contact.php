<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class Contact
{
    static function getAllContacts($userId)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $contacts = array();
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
        $conn->close();
        return $contacts;
    }

    static function createContact($data=[])
    {
        $contactName = $data['contact_name'];
        $phone = $data['phone'];
        $userId = $data['user_id'];
        global $conn;
        $stmt = $conn->prepare("INSERT INTO contacts (contact_name, phone, user_id, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("ssi", $contactName, $phone, $userId);
        $stmt->execute();
        return $conn->insert_id;
    }

    static function getContactById($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    static function updateContact($data=[])
    {
        global $conn;
        $contactName = $data['contact_name'];
        $phone = $data['phone'];
        $userId = $data['user_id'];
        $id = $data['id'];
        $stmt = $conn->prepare("UPDATE contacts SET contact_name = ?, phone = ?, user_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $contactName, $phone, $userId, $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    static function deleteContact($id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}

// $contactModel = new Contact($conn);
