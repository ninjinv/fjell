<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $epost = $_POST['epost'];
    $pwd = hash("sha512", $_POST['pwd']);

    try {
        // Inkluder riktig databaseforbindelse basert på om brukeren er en admin eller ikke
        require_once "db_connection_kunde.php"; // Standard databaseforbindelse
        
        // Sjekk om eposten eksisterer i brukertabellen og om brukeren er en admin
        $query = "SELECT * FROM bruker WHERE epost = :epost AND admin = '1';";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':epost', $epost);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Hvis brukeren er en admin, endre databaseforbindelsen til admin-databasen
            require_once "db_connection_admin.php";
            $_SESSION["id"] = $result["id"];
            $_SESSION["admin"] = '1';
            // Redirect til admin-siden
            header("Location: admin.php");
            exit;
        }

        // Sjekk om eposten eksisterer i brukertabellen
        $query = "SELECT id, epost FROM bruker WHERE epost = :epost AND passord = :pwd;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":epost", $epost);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->execute();

        // Sjekk om brukeren ble funnet
        if ($stmt->rowCount() > 0) {
            $user_id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
            $_SESSION["id"] = $user_id;
            echo '<script>alert("Vellykket innlogging"); window.location.href = "forside.php";</script>';
            exit;
        } else {
            echo '<script>alert("Brukeren eksisterer ikke eller passordet er feil."); window.location.href = "loginpg.php";</script>';
            exit;
        }

    } catch (PDOException $e) {
        echo "Noe gikk galt, prøv igjen! Feilmelding: " . $e->getMessage();
    }
}
?>
