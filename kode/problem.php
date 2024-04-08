<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sjekker om brukeren er logget inn
    if (!isset($_SESSION['epost'])) {
        header("Location: login.php");
        exit();
    }

    // Henter skjemadata og sanitiserer det
    $tittel = $_POST['tittel'];
    $problem = $_POST['problem'];
    $kategori = $_POST['kategori'];

    // Legger til databaseforbindelsen
    require_once "db_connection_kunde.php";

    try {
        // Forbereder SQL-spørringen for å sette inn problemet
        $stmt = $pdo->prepare("INSERT INTO problem (tittel, problem, kategori, bruker_id) VALUES (:tittel, :problem, :kategori, :bruker_id)");
        $stmt->bindParam(':tittel', $tittel);
        $stmt->bindParam(':problem', $problem);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->bindParam(':bruker_id', $_SESSION['bruker_id']);
        
        // Utfører SQL-spørringen
        $stmt->execute();

        // Lukker databaseforbindelsen
        $pdo = null;
        $stmt = null;

        // Omdirigerer til en side etter vellykket innsending av problem
        header("Location: dashboard.php");
        exit();
    } catch(PDOException $e) {
        echo "Noe gikk galt, prøv igjen! Feilmelding: " . $e->getMessage();
    }
}

