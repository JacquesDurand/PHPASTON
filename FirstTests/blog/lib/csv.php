<?php
function loadArticles($filename): array
{
    $articles = [];
    $handle = fopen($filename, 'r');
    if ($handle !== false) {
        while (($data = fgetcsv($handle, 1024)) !== false) {
            $articles[] = [
                'id' => $data[0],
                'title' => $data[1],
                'teaser' => $data[2],
                'content' => $data[3],
                'category' => $data[4],
                'published' => $data[5],
            ];
        };
    }
    return $articles;
}

function saveFile(string $filename, array $articles)
{
    $data = '';
    foreach ($articles as $a) {
        $data .= sprintf("%s,%s,%s,%s,%s,%s\n", $a['id'], $a['title'], $a['teaser'], $a['content'], $a['category'], $a['published']);
    }

   return file_put_contents($filename, $data, LOCK_EX);
}

