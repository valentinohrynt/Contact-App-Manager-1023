<?php
require_once __DIR__ . '/../models/contact.php';

$insertCuy = Contact::createContact('Poniman', '085811620983', '1');
echo $insertCuy;