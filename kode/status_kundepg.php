<?php
session_start();

// Sjekk om brukeren er logget inn
if (!isset($_SESSION["id"])) {
    header("Location: loginpg.php");
    exit;
}

// Inkluder databaseforbindelsen
include "db_connection_kunde.php";

// Hent problemer for den nåværende brukeren inkludert kategorinavn
$user_id = $_SESSION["id"];
try {
    $sql = "SELECT p.*, k.navn AS kategori_navn FROM problem p
            LEFT JOIN kategori k ON p.kategori_id_kategori = k.id_kategori
            WHERE p.bruker_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $problems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Feil ved henting av problemer: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problemstatus</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-6 flex justify-between items-center">  
    <h1 class="text-xl font-semibold">Velkommen til Fjell</h1>  
        <nav class="space-x-4">
            <a href="forside.php" class="text-blue-500 hover:underline">Forsiden</a>
            <a href="problempg.php" class="text-blue-500 hover:underline">Mine Henvendelser</a>
            <a href="status_kundepg.php" class="text-blue-500 hover:underline">Se Mine Henvendelser</a>
        </nav>
    </div>
</div>

<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-4">Dine problemer</h1>
    
    <?php if (!empty($problems)): ?>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Tittel</th>
                    <th class="px-4 py-2">Problem</th>
                    <th class="px-4 py-2">Kategori</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Løsning</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($problems as $problem): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $problem['tittel'] ?></td>
                        <td class="border px-4 py-2"><?= $problem['problem'] ?></td>
                        <td class="border px-4 py-2"><?= $problem['kategori_navn'] ?></td>
                        <td class="border px-4 py-2">
                            <?php
                            if ($problem['status'] == 0) {
                                echo "Ikke løst";
                            } elseif ($problem['status'] == 1) {
                                echo "Løst";
                            } elseif ($problem['status'] == 2) {
                                echo "Kansellert";
                            } else {
                                echo "Ukjent status";
                            }
                            ?>
                        </td>
                        <td class="border px-4 py-2"><?= $problem['losning'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Ingen problemer funnet.</p>
    <?php endif; ?>
    
</div>

</body>
</html>
