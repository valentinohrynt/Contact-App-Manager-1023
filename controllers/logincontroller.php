<?php

require_once __DIR__ .'/../models/user.php';
require_once __DIR__ . '/../app/config/db_connect.php';

class LoginController {
    private $User;

    public function __construct($conn) {
        $this->User = new User($conn);
    }

    public function login($username, $password) {
        $user = $this->User->getUserByUsername($username);
    
        if (!$user || !password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Invalid username atau password'];
        }
    
        session_start();
        $_SESSION['user_id'] = $user['id'];
    
        header('Location: ../dashboard.php');
        exit();
    }
    
}    

$loginController = new LoginController($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = $loginController->login($username, $password);

    if (!$result['success']) {
        echo $result['message'];
    }
}