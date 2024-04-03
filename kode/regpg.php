<?php
  include 'registrering.php';
?>

<html lang="en">
    <head>
        <link rel="stylesheet" href="css\style.css">
        <meta charset="utf-8">
        <title>PHP registrering</title>

    </head>
    <body>
        <p>Opprett ny bruker:</p>
        <form method="post">
            <label for="kallenavn">Kallenavn:</label>
            <input type="text" name="kallenavn" required /><br />

            <label for="epost">E-post:</label>
            <input type="text" name="epost" required /><br />

            <label for="pwd">Passord:</label>
            <input type="password" name="pwd" required /><br />
            
            <input type="submit" value="Registrer her" name="submit" />
        </form>    
    </body>

</html>