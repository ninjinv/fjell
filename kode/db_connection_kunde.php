<?php
// placeholder names and hwavre
$dsn = "mysql:host=localhost;
        dbname=fjell";

$dbusername = "root";
$dbpassword = "Test";

// $pdo = new PDO($dsn, $dbusername, $dbpassword); possible but run try to have error handlers.

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "connection failed: " . $e->getMessage();
}