<?php

require_once "db_connection_kunde.php";

// henting of prepare
$query = "SELECT * FROM problem";
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
</head>
<body>
    <h2>Problemliste</h2>
    <table>
        <thead>
            <tr>
                <th>Tittel</th>
                <th>Beskrivelse</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Løsning</th>
                <th>Tid</th>
                <th>Bruker</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($problemer as $problem): ?>
                <tr>
                    <td><?php echo $problem['tittel']; ?></td>
                    <td><?php echo $problem['problem']; ?></td>
                    <td><?php echo $problem['kategori']; ?></td>
                    <td><?php echo $problem['status']; ?></td>
                    <td><?php echo $problem['losning']; ?></td>
                    <td><?php echo $problem['tid']; ?></td>
                    <td><?php echo $problem['bruker_id']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// close
$pdo = null;
?>
