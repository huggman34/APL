<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
    /**
     * Denna filen används för att kunna uppdatera dagar i dag tabellen i databasen
     * Du väljer vilken dag som ska uppdateras med hjälp av tabellen som finns i 'dagredigering.php'
     * som visar alla dagar i dag tabellen.
     * Sedan så väljer man vad den ska uppdateras till och skickar in det.
     */

        session_start();
        require_once 'connection.php';

        $dagID = $_POST['dagID'];
        $datum = '';

        if(isset($_POST['dagID'])){
            $dagID = $_POST['dagID'];
            $datum = $_POST['datum'];


            $sql = "UPDATE dag SET datum='$datum' WHERE dagID=$dagID";
            mysqli_query($conn, $sql);
            
        }
        header('location: perioddaglista.php');
    ?>
</body>
</html>