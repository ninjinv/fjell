<?php
 
// dont close php code in pure php file
// can cause issues

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $epost = $_POST['epost'];
    $pwd = (hash("sha512", $_POST['pwd']));


    try {
        require_once "db_connection_kunde.php";

        // check if epost exist
        $query = "SELECT * FROM bruker WHERE epost = :epost;";
        $stmt = $pdo -> prepare($query);
        $stmt -> bindParam(':epost', $epost);
        $stmt -> execute();
        $result = $stmt ->fetch(PDO::FETCH_ASSOC);
        
        
        if ($result == true){
        
        $stmt = $pdo->prepare("SELECT epost FROM bruker WHERE epost = :epost AND passord = :pwd;");
        $stmt->bindParam(":epost", $epost);
        $stmt->bindParam(":pwd", $pwd);
        $user_id = $pdo -> lastinsertid(); // User id
        $stmt->execute();
        

    
        } else {
            header( "refresh:0; url=index.php" );
            
            echo '<script>User doesn`t exist :(</script>';
                die("");
        } 
             $pdo = null;
                $stmt = null;  
                $_SESSION["epost"] = $_POST["epost"];      
                header( "refresh:0; url=forside.php" );
                echo '<script> alert("Sign in suckurmom");</script>';
                die("");
    } catch(PDOException $e) {
        echo "Noe gikk galt, prøv igjen! Feilmelding: " . $e->getMessage();
    }
    
}

              