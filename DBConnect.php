<?php

$dsn = 'mysql:dbname=news;host=127.0.0.1';
$user = 'mysql';
$password = 'mysql';

try {
    Object::$db = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
    var_dump($e->getMessage());

}