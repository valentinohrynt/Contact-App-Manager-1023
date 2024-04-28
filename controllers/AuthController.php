<?php
include_once 'models/user.php';
include_once 'function/main.php';
include_once 'app/config/static.php';

class AuthController {
    static function login() {
        view('auth/auth_layout', ['url' => 'login']);
    }

    static function register() {
        view('auth/auth_layout', ['url' => 'register']);
    }

    static function sessionLogin() {
        $post = array_map('htmlspecialchars', $_POST);

        $user = User::login([
            'username' => $post['username'], 
            'password' => $post['password']
        ]);
        if ($user) {
            unset($user['password']);
            $_SESSION['user'] = $user;
            header('Location: '.BASEURL.'dashboard');
        }
        else {
            header('Location: '.BASEURL.'login?failed=true');
        }
    }

    static function newRegister() {
        $post = array_map('htmlspecialchars', $_POST);

        $user = User::register([
            'name' => $post['name'], 
            'username' => $post['username'], 
            'full_name' => $post['full_name'],
            'phone' => $post['phone'],
            'email' => $post['email']
        ]);

        if ($user) {
            header('Location: '.BASEURL.'login');
        }
        else {
            header('Location: '.BASEURL.'register?failed=true');
        }
    }

    static function logout() {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header('Location: '.BASEURL. 'login');
    }
}