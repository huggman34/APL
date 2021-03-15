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
 * 
 */
    session_start();
    require_once 'connection.php';
    require_once 'DeleteFunctions.php';
    require_once 'loginFunctions.php';
    if(checkAdminLogin()) {
        $username = $_SESSION['username'];
        echo "Logged in as " . $username . "<br></br>";
?>
<!--<div class="container2">
<div class="wrapper">
    <h2 class="rubrik2">Länka dagar till perioder</h2>
    <form action="perioddag/perioddagregister.php" method="post">
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
</form>-->
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
        ?>
        <form action='Lists.php' method='post'>
        <input type='submit' onclick="return confirm('Du är på väg att ta bort <?php echo $row['fornamn'], $row['efternamn'];?> från databasen, är du säker?')" name='deleteelev' value='Delete'>
        <?php
        echo "<input type='hidden' name='deleteE' value='$elev'>
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
    $foretag=$row['foretagID'];
    ?>
    <a href="foretag/foretagredigering.php">Uppdatera</a>
    <?php
     echo "</td><td>";
     ?>
     <form action='Lists.php' method='post'>
     <input type="submit" onclick="return confirm('Du är på väg att ta bort <?php echo $row['namn'];?> från databasen, är du säker?')" name="deleteforetag" value="Delete">
     <?php
     echo "<input type='hidden' name='deleteF' value='$foretag'>
     </form>";
    echo "</td></tr>";

}

echo "</table>";

    $sqlget = "SELECT * FROM dag";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>Datum</th><th>Uppdatera information</th><th>Ta bort dag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['datum'];
        echo "</td><td>";
        $dag=$row['dagID'];
        ?>
        <a href="dag/dagredigering.php?id=<?php echo $row['dagID'];?>">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <form action='Lists.php' method='post'>
        <input type='submit' onclick="return confirm('Du är på väg att ta bort <?php echo $row['datum'];?> från databasen, är du säker?')" name='deletedag' value='Delete'>
        <?php
        echo "<input type='hidden' name='deleteD' value='$dag'>
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
        ?>
        <form action='Lists.php' method='post'>
        <input type='submit' onclick="return confirm('Du är på väg att ta bort <?php echo $row['periodNamn'];?> från databasen, är du säker?')" name='deleteperiod' value='Delete'>
        <?php
        echo "<input type='hidden' name='deleteP' value='$period'>
        </form>";
        
        echo "</td></tr>";

    }

echo "</table>";

    $sqlget = "SELECT * FROM perioddag,dag where perioddag.dagID = dag.dagID";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table>";
    echo "<tr><th>perioddagID</th><th>periodNamn</th><th>Datum</th><th>Uppdatera information</th><th>Ta bort perioddag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['perioddagID'];
        echo "</td><td>";
        echo $row['periodNamn'];
        echo "</td><td>";
        echo $row['datum'];
        echo "</td><td>";
        $perioddag=$row['perioddagID'];
        ?>
        <a href="perioddag/perioddagredigering.php">Uppdatera</a>
        <?php
        echo "</td><td>";
        ?>
        <form action='Lists.php' method='post'>
        <input type='submit' onclick="return confirm('Du är på väg att ta bort <?php echo $row['datum'];?> från <?php echo $row['periodNamn'];?>, är du säker?')" name='deleteperioddag' value='Delete'>
        <?php
        echo "<input type='hidden' name='deletePd' value='$perioddag'>
        </form>";
        echo "</td></tr>";

    }

echo "</table>";

$sqlget = "SELECT * FROM plats, foretag where plats.foretagID = foretag.foretagID";
$sqldata = mysqli_query($conn, $sqlget) or die("error");

echo "<table>";
echo "<tr><th>platsID</th><th>periodNamn</th><th>Företag</th><th>ElevID</th><th>Uppdatera information</th><th>Ta bort perioddag</th></tr>";

while($row = mysqli_fetch_assoc($sqldata)) {

    echo "<tr><td>";
    echo $row['platsID'];
    echo "</td><td>";
    echo $row['periodNamn'];
    echo "</td><td>";
    echo $row['namn'];
    echo "</td><td>";
    echo $row['elevID'];
    echo "</td><td>";
    $plats=$row['platsID'];
    ?>
    <a href="plats/platsredigering.php">Uppdatera</a>
    <?php
    echo "</td><td>";
    ?>
    <form action='Lists.php' method='post'>
    <input type='submit' onclick="return confirm('Du är på väg att ta bort <?php echo $row['elevID'];?> från <?php echo $row['namn'];?>, är du säker?')" name='deleteplats' value='Delete'>
    <?php
    echo "<input type='hidden' name='deletePl' value='$plats'>
    </form>";
    echo "</td></tr>";

}

echo "</table>";

if (isset($_POST['deleteperiod'])) {
    deletePeriod($conn,$_POST['deleteP']);
}
if (isset($_POST['deleteperioddag'])) {
    deletePeriodDag($conn,$_POST['deletePd']);
}
if (isset($_POST['deleteelev'])) {
    deleteElev($conn,$_POST['deleteE']);
}
if (isset($_POST['deleteforetag'])) {
    deleteForetag($conn,$_POST['deleteF']);
}
if (isset($_POST['deletedag'])) {
    deleteDag($conn,$_POST['deleteD']);
}
if (isset($_POST['deleteplats'])) {
    deletePlats($conn,$_POST['deletePl']);
}
?>
<a href="index.php" class="tillbaka3">Gå tillbaka</a>
</body>
</html>
<?php
    } else {
        echo "Please log in first to see this page <br></br>";
    }
?>