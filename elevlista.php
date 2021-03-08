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


    $sqlget = "SELECT * FROM elev";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>Förnamn</th><th>Efternamn</th><th>Uppdatera information</th><th>Ta bort elev</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['fornamn'];
        echo "</td><td>";
        echo $row['efternamn'];
        echo "</td><td>";
        ?>
        <a href="elevredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="elevdelete.php?id=<?php echo $row['elevID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<a href="elev.php">Gå tillbaka</a>
</body>
</html>