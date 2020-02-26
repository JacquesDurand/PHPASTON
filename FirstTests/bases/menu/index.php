<?php
$menu = require 'menu.php';
function buildMenu(array $data)
{
    echo '<ul>';
    foreach ($data as $link) {
        if (!isset($link['visible']) || $link['visible']) {
            echo '<li>';
            printf('<a href="%s">%s</a>', $link['link'], $link['name']);
            if (isset($link['menu'])) {
                buildMenu(($link['menu']));
            }
            echo '</li>';
        }
    }
    echo '</ul>';
}

buildMenu($menu);
