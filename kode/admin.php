<?php
// 
session_start();

// Sjekk om en adminsession allerede er aktiv
if (!isset($_SESSION["id"]) || !$_SESSION["admin"]) {
    
    header("Location: loginpg.php");
    exit; 
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminside - Endre problemstatus</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
    </style>
</head>
<body class="bg-gray-100">

<div class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-6 flex justify-between items-center">  
        <h1 class="text-xl font-semibold">Velkommen til Adminside</h1>  
        <nav class="space-x-4">
        <a href="logout.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logg ut</a>
        </nav>
    </div>
</div>

<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Adminside - Endre problemstatus</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
        require_once "db_connection_kunde.php";
        $query = "SELECT problem.*, kategori.navn AS kategori_navn, bruker.kallenavn, bruker.epost 
                  FROM problem 
                  LEFT JOIN kategori ON problem.kategori_id_kategori = kategori.id_kategori
                  LEFT JOIN bruker ON problem.bruker_id = bruker.id";
        $stmt = $pdo->query($query);
        while ($problem = $stmt->fetch(PDO::FETCH_ASSOC)) :
        ?>
        <div class="bg-white shadow-md rounded-lg p-4 card">
            <h2 class="text-lg font-semibold mb-2"><?php echo $problem['tittel']; ?></h2>
            <p class="text-gray-600 mb-2">Sendt inn av: <?php echo $problem['kallenavn']; ?> (<?php echo $problem['epost']; ?>)</p>
            <p class="text-gray-600 mb-4"><?php echo $problem['problem']; ?></p>
            <p class="text-gray-600 mb-4">Kategori: <?php echo $problem['kategori_navn']; ?></p>
            <p class="text-gray-600 mb-4">Status:
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
            </p>
            
            <form action="update_status.php" method="post">
                <input type="hidden" name="problem_id" value="<?php echo $problem['id']; ?>">
                <label for="status" class="block text-sm font-medium text-gray-700">Endre status:</label>
                
                <select id="status" name="status" class="form-select mt-1 block w-full rounded-md border border-gray-400 shadow-sm">
                    <option value="0">Ikke løst</option>
                    <option value="1">Løst</option>
                    <option value="2">Kansellert</option>
                </select>
                <label for="losning" class="block text-sm font-medium text-gray-700 mt-4">Løsning:</label>
                <textarea id="losning" name="losning" rows="4" class="form-textarea mt-1 block w-full rounded-md border border-gray-400 shadow-sm"></textarea>
                <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Oppdater status</button>
            </form>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>