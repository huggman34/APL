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
/**
 * Denna fil är den primära filen för output i form av tabeller.
 * Den innehåller även länkar för att uppdatera och ta bort data i varje tabell.
 * 
 */
    session_start();
    include_once '../connection.php';
?>
<div class="container2">
<div class="wrapper">
    <h2 class="rubrik2">Länka dagar till perioder</h2>
    <form action="perioddagregister.php" method="post">
    <div class="form-group3">
        <label>Välj period </label> 
        <input type="text" name ="periodNamn" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group3">
        <label>Välj dag genom ID</label>
        <input type="text" name ="dagID" class="form-control">
        <span class="help-block"></span>
    </div>
    <div class="form-group4">
        <input type= "submit" class="btn" value="Skicka">
    </div>
</div>
</div>
<?php

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
        <a href="../elev/elevredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="../elev/elevdelete.php?id=<?php echo $row['elevID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";

$sqlget = "SELECT * FROM foretag";
$sqldata = mysqli_query($conn, $sqlget) or die("error");

echo "<table>";
echo "<tr><th>Företagsnamn</th><th>Epost</th><th>Telefonnummer</th><th>Uppdatera information</th><th>Ta bort företag</th></tr>";

while($row = mysqli_fetch_assoc($sqldata)) {

    echo "<tr><td>";
    echo $row['namn'];
    echo "</td><td>";
    echo $row['epost'];
    echo "</td><td>";
    echo $row['telefon'];
    echo "</td><td>";
    ?>
    <a href="../foretag/foretagredigering.php">Uppdatera</a>
    <?php
     echo "</td><td>";
     ?>
     <a href="../foretag/foretagdelete.php?id=<?php echo $row['foretagsID'];?>">Delete</a>
     <?php
    echo "</td></tr>";

}

echo "</table>";

    $sqlget = "SELECT * FROM dag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>dagID</th><th>Datum</th><th>Uppdatera information</th><th>Ta bort dag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['dagID'];
        echo "</td><td>";
        echo $row['datum'];
        echo "</td><td>";
        ?>
        <a href="../dagredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="../dagdelete.php?id=<?php echo $row['dagID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";

    $sqlget = "SELECT * FROM period";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>periodNamn</th><th>Startdatum</th><th>Slutdatum</th><th>Uppdatera information</th><th>Ta bort period</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['periodNamn'];
        echo "</td><td>";
        echo $row['startdatum'];
        echo "</td><td>";
        echo $row['slutdatum'];
        echo "</td><td>";
        ?>
        <a href="../periodredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="../perioddelete.php?id=<?php echo $row['periodNamn'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";

    $sqlget = "SELECT * FROM perioddag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>perioddagID</th><th>periodNamn</th><th>dagID</th><th>Uppdatera information</th><th>Ta bort perioddag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['perioddagID'];
        echo "</td><td>";
        echo $row['periodNamn'];
        echo "</td><td>";
        echo $row['dagID'];
        echo "</td><td>";
        ?>
        <a href="perioddagredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <a href="perioddagdelete.php?id=<?php echo $row['perioddagID'];?>">Delete</a>
        <?php
        echo "</td></tr>";

    }

echo "</table>";
?>
<a href="perioddag.php" class="tillbaka3">Gå tillbaka</a>
</body>
</html>