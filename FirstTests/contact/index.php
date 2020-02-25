<?php

// a l 'ancienne
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';

//mieux
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

$contacts = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // sauvegarde en csv (comma separated value)
    // firstname,lastname,email,phone

    // "" pour pouvoir interpreter les donnees a l'interieur
    $row = "$firstname,$lastname,$email,$phone\n";
    file_put_contents('contacts.csv', $row, FILE_APPEND);
}

//get the content
// 'r' === read
$handle = fopen('contacts.csv', 'r');

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
