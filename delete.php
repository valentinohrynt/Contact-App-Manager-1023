<?php
require_once __DIR__ . '/../models/contact.php';

$deleteCuy = Contact::deleteContact('1');
echo $deleteCuy;