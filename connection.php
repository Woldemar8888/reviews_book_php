<?php
$dsn = 'mysql:dbname=reviews;port=3307;host=127.0.0.1';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
?>