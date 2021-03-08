<html>
<head>
<link rel="stylesheet" href="apl.css">
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
</head>
<body>
<?php

    session_start();
    include_once 'connection.php';


    $sqlget = "SELECT * FROM foretag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>Företagsnamn</th><th>Epost</th><th>Telefonnummer</th><th>Uppdatera information</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['namn'];
        echo "</td><td>";
        echo $row['epost'];
        echo "</td><td>";
        echo $row['telefon'];
        echo "</td><td>";
        ?>
        <a href="foretagredigering.php">Uppdatera</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<?php
        $sqlget = "SELECT * FROM foretag";
        $sqldata = mysqli_query($conn, $sqlget) or die("error");

        echo '<form action="foretagdelete.php" method="post">';
        echo '<label for="namn">Välj företag:</label>';
        echo '<select id="foretagsID" name="foretagsID">';
        while($row = mysqli_fetch_array($sqldata)){
 
        echo '<option value="' . $row["foretagsID"] . '" >'. $row["namn"] .'</option>';
        
        }
        echo '</select>';
        
?>
<button type="submit" name="delete">Ta bort</button>
</form>
<a href="foretag.php">Gå tillbaka</a>
</body>
</html>