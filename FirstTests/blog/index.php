<?php

require 'lib/validators.php';
require 'lib/csv.php';
$articles = loadArticles('articles.csv');

$title = $_POST['title'] ?? '';
$teaser = $_POST['teaser'] ?? '';
$content = $_POST['content'] ?? '';
$published = isset($_POST['published']) ? 1 : 0;
$category = $_POST['category'] ?? '';
$options = ['cat1', 'cat2', 'cat3'];

$errors = [];
$id = sizeof($articles);

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
        $id++;
        $articles[] = [
            'id' => $id,
            'title' => $title,
            'teaser' => $teaser,
            'content' => $content,
            'category' => $category,
            'published' => $published
        ];
        saveFile('articles.csv', $articles);
    }
}

$queryString = $_SERVER['QUERY_STRING'] ?? '';
if (strpos($queryString, 'action=remove') !== false) {
    $id = substr($queryString, -1);
    array_splice($articles, intval($id), 1);
    saveFile('articles.csv', $articles);
    loadArticles('articles.csv');
    header('location: http://localhost:80/PHPASTON/FirstTests/blog/');
}


include 'views/page.phtml';
