<?php
  include 'problem.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem side</title>
</head>
<body>
    
<div>
    <p>Skriv inn problem:</p>
    <form action="problem.php" method="post">
        <label for="kallenavn">Tittel:</label>
        <input type="text" name="kallenavn" required /><br />

        <label for="beskrivelse">Beskrivelse av problemet:</label>
        <input type="text" name="beskrivelse" required rows="2" cols="25"/><br />

        <select name="kategori" id="kategori">
        <option value="faktura">Faktura</option>
        <option value="Suppoert">Suppoert</option>
        <option value="Vedlikehold">Vedlikehold</option>
        <option value="Programvarelisens">Programvarelisens</option>
        <option value="annet">Annet</option>
        </select>
        
        <input type="submit" value="Lever inn problem" name="submit" />
    </form> 
</div>

</body>
</html>