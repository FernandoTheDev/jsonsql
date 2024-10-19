<?php

use Fernando\JsonSQL\JsonSQL;

require_once __DIR__ . "/../vendor/autoload.php";

$file = __DIR__ . "/users.json";
$jsonsql = new JsonSQL(file: $file);

// * true
$jsonsql->insert(key: 'fernandothedev', array: [
    'name' => 'Fernando',
    'age' => 16,
    'love' => 'php'
]);

// * true
$jsonsql->insert(key: 'fulano', array: [
    'name' => 'Fulano',
    'age' => 999,
    'love' => 'daucu'
]);