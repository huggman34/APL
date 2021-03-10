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
 * När man klickar på antingen uppdatera eller delete kollar den igenom vilket ID det hör till och ändrar det sedan i den tabellen.
 *
 *  ToDo:
 * lat lösning på rad 194.
 * 
 */
    session_start();
    include_once 'connection.php';
    include_once 'DeletFunctions.php';
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
        $elev=$row['elevID']
        ?>
        <a href="elev/elevredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        echo"<form action='Lists.php' method='post'>
        <input type='submit' name='deletelev' value='Delet'>
        <input type='hidden' name='deletE' value='$elev'>
        </form>";
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
    $foretag=$row['foretagsID'];
    ?>
    <a href="foretag/foretagredigering.php">Uppdatera</a>
    <?php
     echo "</td><td>";
     echo"<form action='Lists.php' method='post'>
     <input type='submit' name='deletforetag' value='Delet'>
     <input type='hidden' name='deletF' value='$foretag'>
     </form>";
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
        $dag=$row['dagID'];
        ?>
        <a href="dagredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";

        echo"<form action='Lists.php' method='post'>
        <input type='submit' name='deletdag' value='Delet'>
        <input type='hidden' name='deletD' value='$dag'>
        </form>";

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
        $period=$row['periodNamn'];
        ?>
        <a href="period/periodredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        
        echo"<form action='Lists.php' method='post'>
        <input type='submit' name='deletperiod' value='Delet'>
        <input type='hidden' name='deletP' value='$period'>
        </form>";
        
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
        $perioddag=$row['perioddagID'];
        ?>
        <a href="perioddag/perioddagredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        echo"<form action='Lists.php' method='post'>
        <input type='submit' name='deletperioddag' value='Delet'>
        <input type='hidden' name='deletPd' value='$perioddag'>
        </form>";
        echo "</td></tr>";

    }

echo "</table>";

if (isset($_POST['deletperiod'])) {
    deletePeriod($conn,$_POST['deletP']);
}
if (isset($_POST['deletperioddag'])) {
    deletePeriodDag($conn,$_POST['deletPd']);
}
if (isset($_POST['deletelev'])) {
    deleteElev($conn,$_POST['deletE']);
}
if (isset($_POST['deletforetag'])) {
    deleteForetag($conn,$_POST['deletF']);
}
if (isset($_POST['deletdag'])) {
    deleteDag($conn,$_POST['deletD']);
}
?>
<a href="perioddag.php" class="tillbaka3">Gå tillbaka</a>
</body>
</html>