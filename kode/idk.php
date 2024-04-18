<?php
session_start();

require_once "db_connection_kunde.php";

if (!isset($_SESSION["id"])) {
    header("Location: loginpg.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["passord"]) && isset($_POST["kallenavn"])) {
        $passord = $_POST["passord"];
        $kallenavn = $_POST["kallenavn"];
        $bruker_id = $_SESSION["id"];

        $query = "UPDATE bruker SET passord = :passord, kallenavn = :kallenavn WHERE id = :bruker_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":passord", $passord);
        $stmt->bindParam(":kallenavn", $kallenavn);
        $stmt->bindParam(":bruker_id", $bruker_id);

        if ($stmt->execute()) {
            echo "Passord og kallenavn er oppdatert.";
        } else {
            echo "Noe gikk galt. Passord og kallenavn ble ikke oppdatert.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oppdater brukerinformasjon</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-100">

<div class="container mx-auto mt-8">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Oppdater brukerinformasjon</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-4">
                    <label for="passord" class="block text-sm font-medium text-gray-700">Nytt passord:</label>
                    <input type="password" name="passord" id="passord" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="kallenavn" class="block text-sm font-medium text-gray-700">Nytt kallenavn:</label>
                    <input type="text" name="kallenavn" id="kallenavn" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Oppdater informasjon</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
