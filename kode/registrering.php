<?php

// don't close PHP tag in a pure PHP file
// can cause issues

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $navn = $_POST['kallenavn'];
    $epost = $_POST['epost'];
    $pwd = (hash("sha512", $_POST['pwd']));

    try {
        require_once "db_connection_kunde.php";

        // Sjekke om epost allerede er registrert
        $query = "SELECT * FROM bruker WHERE epost = :epost;";
            $stmt = $pdo -> prepare($query);
            $stmt -> bindParam(':epost', $epost);
            $stmt -> execute();
            $result = $stmt ->fetch(PDO::FETCH_ASSOC);
            // var_dump($result);
            // print $result;
            // print_r($result);
            
        if ($result == false){
            $stmt = $pdo->prepare("INSERT INTO bruker (kallenavn, epost, passord) VALUES (:kallenavn, :epost, :pwd)");
            $stmt->bindParam(':kallenavn', $navn);
            $stmt->bindParam(':epost', $epost);
            $stmt->bindParam(':pwd', $pwd);
            $user_id = $pdo -> lastinsertid(); // User id
            $stmt->execute();

            // alerrt hvis det gikk
            echo '<script>alert("Registrering vellykket!");</script>';

            // go login
            header("refresh:0; url=login.php");
            exit();

        } else {
            $pdo = null;
            $stmt = null; 
            echo '<script>alert("Eposten er allerede tatt!");</script>';
            exit();
        }                
            
    } catch(PDOException $e) {
        echo "Noe gikk galt, prøv igjen! Feilmelding: " . $e->getMessage();
    }

    // Disconnect from the database
    $pdo = null;
    $stmt = null; 
}

