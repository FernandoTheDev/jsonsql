<?php

use Fernando\JsonSQL\JsonSQL;

require_once __DIR__ . "/../vendor/autoload.php";

$file = __DIR__ . "/users.json";
$jsonsql = new JsonSQL(file: $file);

// ! false
$jsonsql->delete(key: 'fernando2');

// ! false
$jsonsql->delete(key: 'fernando', array: [
    'key-dont-exists'
]);

// * true
$jsonsql->delete(key: 'fulano');

// * true
$jsonsql->delete(key: 'fernandothedev', array: [
    'love'
]);
