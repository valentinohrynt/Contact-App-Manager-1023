<?php
require_once __DIR__ . '../models/contact.php';

$deleteCuy = Contact::deleteContact($conn, '1');
echo $deleteCuy;