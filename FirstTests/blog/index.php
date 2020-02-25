<?php

require 'lib/validators.php';

$title = $_POST['title'] ?? '';
$teaser = $_POST['teaser'] ?? '';
$content = $_POST['content'] ?? '';
$published = isset($_POST['published']) ? 1 : 0;
$category = $_POST['category'] ?? '';
$id ;

$options = ['cat1', 'cat2', 'cat3'];

$articles = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isEmpty($title)) {
        $errors[] = 'title is required';
    }
    if (isEmpty($teaser)) {
        $errors[] = 'teaser is required';
    }
    if (isEmpty($content)) {
        $errors[] = 'content is required';
    }
    if (empty($errors)) {
        $title = strip_tags($title);
        $teaser = strip_tags($teaser);
        $content = strip_tags($content);
        if ($published === 1) {
            $published = 'publié';
        } else {
            $published = 'non publié';
        }

        $row = "$title,$teaser,$content,$category,$published\n";
        file_put_contents('articles.csv', $row, FILE_APPEND);
    }
}

$handle = fopen('articles.csv', 'r');

if ($handle !== false) {
    while (($data = fgetcsv($handle, 1024)) !== false) {
        $articles[] = [
            'title' => $data[0],
            'teaser' => $data[1],
            'content' => $data[2],
            'category' => $data[3],
            'published' => $data[4],
        ];
    };
}


include 'views/page.phtml';
