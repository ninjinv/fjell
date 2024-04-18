<?php
// placeholder names and hwavre
$dsn = "mysql:host=localhost;
        dbname=fjell";

$dbusername = "admin";
$dbpassword = "admin123";


try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "connection failed: " . $e->getMessage();
}