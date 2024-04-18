<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Forside</title>
</head>
<body class="bg-gray-100">

<?php
session_start();

// Sjekk om brukeren er innlogget
if (isset($_SESSION["id"])) {
    // Brukeren er innlogget
    $user_id = $_SESSION["id"];
    
    echo '<a href="logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logg ut</a>';
} else {
    // Brukeren er ikke innlogget, omdiriger til innloggingssiden
    header("Location: loginpg.php");
    exit;
}

?>

<div class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Velkommen til Fjell</h1>
            <nav class="space-x-4">
                <a href="forside.php" class="text-blue-500 hover:underline">Forsiden</a>
                <a href="mine_henvendelser.php" class="text-blue-500 hover:underline">Mine Henvendelser</a>
                <a href="se_mine_henvendelser.php" class="text-blue-500 hover:underline">Se Mine Henvendelser</a>
            </nav>
        </div>
    </div>

<!-- Ny henvendelse -->
<div class="my-8 mx-auto max-w-md">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-xl font-bold mb-4">Lag ny henvendelse av deg</h2>
        <a href="problempg.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block text-center">Gå til ny henvendelse</a>
    </div>
</div>

<!-- Status side -->
<div class="my-8 mx-auto max-w-md">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-xl font-bold mb-4">Status siden din</h2>
        <a href="status_kundepg.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block text-center">Gå til status side</a>
    </div>
</div>

</body>
</html>
