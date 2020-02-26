<?php

// Tableau à index numérique 

$num_arr1 = ['a', 'b', 'c'];

//à la voléee

$num_arr2[] = 'a';
$num_arr2[] = 'b';
$num_arr2[] = 'c';

// echo '<pre>';
// var_dump($num_arr1);
// var_dump($num_arr2);
// echo '</pre>';

// Tableau associatif

$ass_arr = [
    'username' => 'toto',
    'key' => 'value',
    1 => 'test',
    'funk' => function () {
        echo 'time to get shwifty';
    },
];

$ass_arr['age'] = 32;
$id = 'funk';

echo '<pre>';
var_dump($ass_arr[$id]);
echo '</pre>';

//Tableau multidimensionnel

$mult_arr = [
    'phones' => [
        '00000000',
        '11111111',
        '22222222',
    ],
];

var_dump($mult_arr['phones'][2]);