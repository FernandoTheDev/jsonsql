<?php

use Fernando\JsonSQL\JsonSQL;

require_once __DIR__ . "/../vendor/autoload.php";

$file = __DIR__ . "/users.json";
$jsonsql = new JsonSQL(file: $file);

// * true [ unic user ]
$jsonsql->update(key: 'fernandothedev', array: [
    'love' => 'water'
]);

sleep(seconds: 3);

// * true [ all users ]
var_dump($jsonsql->update(array: [
    'love' => 'money'
]));
