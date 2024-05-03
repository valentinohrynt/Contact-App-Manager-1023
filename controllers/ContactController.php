<?php
include_once 'models/contact.php';

class ContactController
{
    static function createContact()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'login?auth=false');
            exit;
        } else {
            $post = array_map('htmlspecialchars', $_POST);
            $contact = Contact::createContact([
                'contact_name' => $post['contactName'],
                'phone' => $post['phone'],
                'user_id' => $_SESSION['user']['id']
            ]);

            if ($contact) {
                header('Location: ' . BASEURL . 'dashboard');
            } else {
                echo ('Terjadi kesalahan');
            }
        }
    }

    static function updateContact()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'login?auth=false');
            exit;
        } else {
            $post = array_map('htmlspecialchars', $_POST);
            $contact = Contact::updateContact([
                'id' => $post['contactId'],
                'contact_name' => $post['contactName'],
                'phone' => $post['phone'],
                'user_id' => $_SESSION['user']['id'],
            ]);
            if ($contact) {
                header('Location: ' . BASEURL . 'dashboard');
            } else {
                echo ('Terjadi kesalahan');
            }
        }
    }

    static function deleteContact()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . 'login?auth=false');
            exit;
        } else {
            $post = array_map('htmlspecialchars', $_POST);
            $contact = Contact::deleteContact($_POST['contactId']);
            if ($contact) {
                header('Location: ' . BASEURL . 'dashboard');
            } else {
                echo ('Terjadi kesalahan');
            }
        }
    }
}
