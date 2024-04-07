<?php

require_once __DIR__ .'/../models/user.php';
require_once __DIR__ . '/../app/config/db_connect.php';

class RegisterController {
    private $User;

    public function __construct($conn) {
        $this->User = new User($conn);
    }

    public function register($username, $password, $fullName, $phone, $email) {
        $existingUser = $this->User->getUserByUsername($username);
        if ($existingUser) {
            return ['success' => false, 'message' => 'Username sudah terpakai'];
        }
        $existingEmail = $this->User->getUserByEmail($email);
        if ($existingEmail) {
            return ['success' => false, 'message' => 'Email sudah terpakai'];
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $userId = $this->User->createUser($username, $passwordHash, $fullName, $phone, $email);
        if ($userId) {
            header('Location: ../index.php');
            exit(); 
        } else {
            return ['success' => false, 'message' => 'Gagal register'];
        }
    }
}    

$registerController = new RegisterController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $fullName = $_POST["full_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $result = $registerController->register($username, $password, $fullName, $phone, $email);

    if (!$result['success']) {
        echo $result['message'];
    }
}
?>
