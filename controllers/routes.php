<?php

// Auth
Router::url('login', 'get', 'AuthController::login');
Router::url('login', 'post', 'AuthController::sessionLogin');
Router::url('register', 'get', 'AuthController::register');
Router::url('register', 'post', 'AuthController::newRegister');
Router::url('logout', 'get', 'AuthController::logout');


// Dashboard
Router::url('dashboard', 'get', 'DashboardController::index');
Router::url('dashboard/add-contact', 'post', 'ContactController::createContact');
Router::url('dashboard/edit-contact', 'post', 'ContactController::updateContact');
Router::url('dashboard/delete-contact', 'post', 'ContactController::deleteContact');


Router::url('/', 'get', function () {
    header('Location: login');
});