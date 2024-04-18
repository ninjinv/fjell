<?php
session_start();

// Sjekk om en adminsession er aktiv
if (!isset($_SESSION["id"]) || $_SESSION["admin"] != 1) {
    // Hvis ingen adminsession er aktiv, omdiriger brukeren til innloggingssiden for admin
    header("Location: loginpg.php");
    exit;
}

// Sjekk om det er en POST-forespørsel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hent problem-ID og status fra skjemaet
    $problem_id = $_POST["problem_id"];
    $status = $_POST["status"];
    $losning = $_POST["losning"];

    // Inkluder databaseforbindelsen
    require_once "db_connection_admin.php";

    try {
        // Oppdater statusen og løsningen i databasen
        $query = "UPDATE problem SET status = :status, losning = :losning WHERE id = :problem_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":losning", $losning);
        $stmt->bindParam(":problem_id", $problem_id);
        $stmt->execute();

        // Vis en melding etter at statusen er oppdatert
        $message = "Statusen for problemet er oppdatert.";

        // Lagre meldingen i en PHP-variabel for å vise den direkte i JavaScript-echoen
        $js_message = addslashes($message); // Escaper spesielle tegn i meldingen

        // Generer JavaScript-koden som viser meldingen
        echo '<script>alert("' . $js_message . '");</script>';

        // Omdiriger tilbake til admin-siden
        header("Location: admin.php");
        exit;
    } catch (PDOException $e) {
        // Hvis det oppstår en feil, vis feilmeldingen og omdiriger tilbake til admin-siden
        echo "Feil: " . $e->getMessage();
        exit;
    }
} else {
    // Hvis det ikke er en POST-forespørsel, omdiriger brukeren tilbake til admin-siden
    header("Location: admin.php");
    exit;
}
