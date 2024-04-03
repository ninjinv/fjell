<?php

include 'db_connection_kunde.php';

// resumer session
session_start();

session_unset(); // fjerner variabler
session_destroy(); // avslutter

header("Location: index.php"); // sender deg til logg inn
exit;
