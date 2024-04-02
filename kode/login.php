<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sjekk pålogging</title>
</head>
<body>
    <?php
        if(isset($_POST['submit'])){
            //Gjøre om POST-data til variabler
            $brukernavn = $_POST['brukernavn'];
            $passord = (hash("sha512", $_POST['passord']));
            
            //Koble til databasen
            $dbc = mysqli_connect('localhost', 'root', 'Test', 'mydb')
              or die('Error connecting to MySQL server.');
            
            //Gjøre klar SQL-strengen
            $query = "SELECT username, password, vote from users where username='$brukernavn' and password='$passord' and vote='$vote'";
            // "INSERT INTO users VALUES ('$brukernavn', 'passord')";

            //Utføre spørringen
            $result = mysqli_query($dbc, $query)
              or die('Error querying database.');
            
            //Koble fra databasen
            mysqli_close($dbc);

            //Sjekke om spørringen gir resultater
            if($result->num_rows > 0){
                // Start a session
                session_start();
                // Store user information in the session
                $_SESSION['username'] = $brukernavn;
                $_SESSION['vote'] = $vote;
                // Redirect to a welcome page or dashboard
                header('location: welcome.php');
            } else {
                // Invalid login
                header('location: index.html');
            }

        }
    ?>
</body>
</html>