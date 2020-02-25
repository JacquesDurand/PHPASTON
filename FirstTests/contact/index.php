<?php
require 'lib/validators.php';

define('CONTACT_PATH', 'contacts.csv');

// a l 'ancienne
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';

//mieux
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

$contacts = [];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // sauvegarde en csv (comma separated value)
    // firstname,lastname,email,phone

    //Ici on valide les données
    if (isEmpty($firstname)) {
        $errors[] = 'firstname is required';
    }
    if (isEmpty($lastname)) {
        $errors[] = 'lastname is required';
    }
    if (isEmpty($email)) {
        $errors[] = 'email is required';
    }
    if (isEmpty($phone)) {
        $errors[] = 'phone is required';
    }

    // "" pour pouvoir interpreter les donnees a l'interieur
    if (empty($errors)) {
        $firstname = strip_tags($firstname);
        $lastname = strip_tags($lastname);
        $email = strip_tags($email);
        $phone = strip_tags($phone);
        $row = "$firstname,$lastname,$email,$phone\n";
        file_put_contents(CONTACT_PATH, $row, FILE_APPEND);
    }
}

//get the content
// 'r' === read
$handle = fopen(CONTACT_PATH, 'r');

if ($handle !== false) {
    while (($data = fgetcsv($handle, 1024)) !== false) {
        $contacts[] = [
            'firstname' => $data[0],
            'lastname' => $data[1],
            'email' => $data[2],
            'phone' => $data[3],
        ];
    };
}

include 'views/page.phtml';
