<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legg til problem</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">

<!-- <div class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-6 flex justify-between items-center">    
        <nav class="space-x-4">
        <h1 class="text-xl font-semibold">Velkommen til Fjell</h1>
            <a href="forside.php" class="text-blue-500 hover:underline">Forsiden</a>
            <a href="problempg.php" class="text-blue-500 hover:underline">Mine Henvendelser</a>
            <a href="status_kundepg.php" class="text-blue-500 hover:underline">Se Mine Henvendelser</a>
        </nav>
    </div>
</div> -->

<?php
session_start();

// Sjekk om brukeren er innlogget
if (isset($_SESSION["id"])) {
    // Brukeren er innlogget
    $user_id = $_SESSION["id"];
    
} else {
    // Brukeren er ikke innlogget, omdiriger til innloggingssiden
    header("Location: loginpg.php");
    exit;
}

include "db_connection_kunde.php";
?>



<div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full md:w-2/3 lg:w-1/2">
    <h2 class="text-2xl font-bold mb-4">Legg til nytt problem</h2>
    <form action="problem.php" method="post">
        <div class="mb-4">
            <label for="tittel" class="block text-sm font-medium text-gray-700">Tittel:</label>
            <input type="text" id="tittel" name="tittel" class="form-input mt-1 block w-full rounded-md border border-gray-400 shadow-sm">
        </div>
        <div class="mb-4">
            <label for="problem" class="block text-sm font-medium text-gray-700">Problem:</label>
            <textarea id="problem" name="problem" rows="4" class="form-textarea mt-1 block w-full rounded-md border border-gray-400 shadow-sm"></textarea>
        </div>
        <div class="mb-4">
            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori:</label>
            <select id="kategori" name="kategori" class="form-select mt-1 block w-full rounded-md border border-gray-400 shadow-sm">
                <?php
                // Koble til databasen og hent kategorier fra databasen
                include "db_connection_kunde.php";
                try {
                    $conn = new PDO($dsn, $dbusername, $dbpassword);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    $sql = "SELECT id_kategori, navn FROM kategori";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                    if (count($result) > 0) {
                        foreach ($result as $row) {
                            echo "<option value='" . $row['id_kategori'] . "'>" . $row['navn'] . "</option>";
                        }
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                ?>
            </select>
        </div>
        <!-- Legg tilbake submit-knappen -->
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 border border-blue-500">Legg til problem</button>
        </div>
    </form>
</div>

</body>
</html>
