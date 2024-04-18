<?php

require_once "db_connection_kunde.php";

// Henting av prepare
$query = "SELECT problem.*, kategori.navn AS kategori_navn, bruker.kallenavn AS bruker_kallenavn 
          FROM problem 
          LEFT JOIN kategori ON problem.kategori_id_kategori = kategori.id_kategori
          LEFT JOIN bruker ON problem.bruker_id = bruker.id";
$stmt = $pdo->prepare($query);
$stmt->execute();
$problemer = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problemliste</title>
    <!-- Include the Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-100">

<div class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-6 flex justify-between items-center"> 
        <h1 class="text-xl font-semibold">Velkommen til Fjell</h1>   
        <nav class="space-x-4">
            <a href="regpg.php" class="text-blue-500 hover:underline">Registrer deg her</a>
            <a href="loginpg.php" class="text-blue-500 hover:underline">Logg inn her</a>
        </nav>
    </div>
</div>

    
<div class="max-w-full mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold mb-4">Problemliste</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tittel</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Beskrivelse</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Løsning</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tid</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bruker</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($problemer as $problem): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $problem['tittel']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $problem['problem']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php 
                            // Endre kategoriene til tekst basert på kategori ID
                            switch ($problem['kategori_id_kategori']) {
                                case 1:
                                    echo "Utvikling";
                                    break;
                                case 2:
                                    echo "Drift";
                                    break;
                                case 3:
                                    echo "Annet";
                                    break;
                                default:
                                    echo "Ukjent kategori";
                            }
                            ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php
                            if ($problem['status'] == 0) {
                                echo "Ikke løst";
                            } elseif ($problem['status'] == 1) {
                                echo "Løst";
                            } elseif ($problem['status'] == 2) {
                                echo "Kansellert";
                            } else {
                                echo "Ukjent status";
                            }
                            ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $problem['losning']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $problem['tid']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $problem['bruker_kallenavn']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Lukk
$pdo = null;
?>