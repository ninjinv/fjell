<?php
$servername = "localhost";
$username = "admin";
$password = "admin123";
$database = "fjell";


$conn_admin = new mysqli($servername, $username, $password, $database);

// Sjekker tilkoblingen
if ($conn_admin->connect_error) {
    die("Tilkoblingsfeil: " . $conn_admin->connect_error);
}

