<?php

require_once __DIR__ . '/../models/contact.php';
require_once __DIR__ . '/../app/config/db_connect.php';

class ContactController
{
    private $Contact;

    public function __construct($conn)
    {
        $this->Contact = new Contact($conn);
    }
    public function getAllContacts($userId)
    {
        return $this->Contact->getAllContacts($userId);
    }

    public function addContact($contactName, $phone, $userId)
    {
        $contactId = $this->Contact->createContact($contactName, $phone, $userId);
        if ($contactId) {
            header('Location: ../dashboard.php');
            exit();
        } else {
            return ['success' => false, 'message' => 'Gagal menambahkan kontak'];
        }
    }

    public function updateContact($id, $contactName, $phone, $userId)
    {
        $result = $this->Contact->updateContact($id, $contactName, $phone, $userId);
        if ($result) {
            header('Location: ../dashboard.php');
            exit();
        } else {
            return ['success' => false, 'message' => 'Gagal mengubah kontak'];
        }
    }
    public function deleteContact($contactId) {
        $result = $this->Contact->deleteContact($contactId);
        if ($result) {
            header('Location: ../dashboard.php');
            exit();
        } else {
            return ['success' => false, 'message' => 'Gagal menghapus kontak'];
        }
    }
    
}

$contactController = new ContactController($conn);
$action = isset($_GET['action']) ? $_GET['action'] : '';


if ($action == 'update') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $userId = $_SESSION['user_id'];
        $contactId = $_POST['contactId'];
        $contactName = $_POST['contactName'];
        $phone = $_POST['phone'];

        $result = $contactController->updateContact($contactId, $contactName, $phone, $userId);

        if ($result['success']) {
            header('Location: dashboard.php');
            exit();
        } else {
            echo $result['message'];
        }
    }
}

if ($action == 'add'){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $userId = $_SESSION['user_id'];
        $contactName = $_POST['contactName'];
        $phone = $_POST['phone'];
    
        $result = $contactController->addContact($contactName, $phone, $userId);
    
        echo $result['message'];
    }
}
if ($action == 'delete'){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $contactId = $_POST['contactId'];
    
        $result = $contactController->deleteContact($contactId);
    
        echo $result['message'];
    }
}
