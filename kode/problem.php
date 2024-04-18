<?php
session_start();

if (isset($_SESSION["id"])) {
    // Brukeren er innlogget
    $user_id = $_SESSION["id"];
    
} else {
    // Brukeren er ikke innlogget, omdiriger til innloggingssiden
    header("Location: loginpg.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tittel = $_POST['tittel'] ?? '';
    $problem = $_POST['problem'] ?? '';
    $kategori = $_POST['kategori'] ?? '';
    $status = 0;
    $losning = '';
    $bruker_id = $user_id; // Bruker den hentede bruker-IDen
    $id_kategori = $_POST['kategori'] ?? ''; // Bruker kategori som ble sendt fra skjema

    if ($tittel && $problem && $kategori && $bruker_id && $id_kategori) {
        require_once "db_connection_kunde.php";
        try {
            $sql = "INSERT INTO problem (tittel, problem, kategori, status, losning, bruker_id, kategori_id_kategori) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $tittel);
            $stmt->bindParam(2, $problem);
            $stmt->bindParam(3, $kategori);
            $stmt->bindParam(4, $status);
            $stmt->bindParam(5, $losning);
            $stmt->bindParam(6, $bruker_id);
            $stmt->bindParam(7, $id_kategori);
            if ($stmt->execute()) {
                echo '<script>alert("Vellykket, problemet ditt er sendt inn"); window.location.href = "forside.php";</script>;</script>';
            } else {
                echo "Feil";
            }
            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo "Noe gikk galt, prøv igjen! Feilmelding: " . $e->getMessage();
        }
    } else {
        echo "Manglende informasjon. Følgende felt mangler: ";
        if (empty($tittel)) {
            echo "Tittel ";
        }
        if (empty($problem)) {
            echo "Problem ";
        }
        if (empty($kategori)) {
            echo "Kategori ";
        }
        if (empty($bruker_id)) {
            echo "Bruker ID ";
        }
        if (empty($id_kategori)) {
            echo "Kategori ID ";
        }
    }
} else {
    echo "Feil metode. Vennligst bruk POST-metoden for å sende data.";
}
