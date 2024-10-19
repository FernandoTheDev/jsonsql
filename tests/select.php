<?php

use Fernando\JsonSQL\JsonSQL;

require_once __DIR__ . "/../vendor/autoload.php";

$file = __DIR__ . "/users.json";
$jsonsql = new JsonSQL(file: $file);

// ! false
var_dump($jsonsql->select(key: 'fernando'));

// & array
print_r($jsonsql->select(key: 'fernandothedev'));

// * array<mixed> but not false
var_dump($jsonsql->select(key: 'fernandothedev', array: [
    'name'
]));
