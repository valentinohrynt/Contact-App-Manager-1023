<?php
require_once __DIR__ . '/../models/contact.php';

$updateCuy = Contact::updateContact('1', 'Dontol', '082143981626', '1');
echo $updateCuy;