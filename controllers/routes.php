<?php

// Auth
route('login', 'get', 'AuthController::login');
route('login', 'post', 'AuthController::sessionLogin');
route('register', 'get', 'AuthController::register');
route('register', 'post', 'AuthController::newRegister');
route('logout', 'get', 'AuthController::logout');


// Dashboard
route('dashboard', 'get', 'DashboardController::index');
route('dashboard/add-contact', 'post', 'ContactController::createContact');
route('dashboard/edit-contact', 'post', 'ContactController::updateContact');
route('dashboard/delete-contact', 'post', 'ContactController::deleteContact');


route('/', 'get', function () {
    header('Location: login');
});
