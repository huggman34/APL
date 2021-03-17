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
    echo "<tr><th>periodNamn</th><th>Datum</th><th>Uppdatera information</th><th>Ta bort perioddag</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
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
echo "<tr><th>periodNamn</th><th>Företag</th><th>ElevID</th><th>Uppdatera information</th><th>Ta bort perioddag</th></tr>";

while($row = mysqli_fetch_assoc($sqldata)) {

    echo "<tr><td>";
    echo $row['periodNamn'];
    echo "</td><td>";
    echo $row['namn'];
    echo "</td><td>";
    echo $row['elevID'];
    echo "</td><td>";
    $plats=$row['platsID'];
    
   echo" <a href='plats/platsRedigering.php?id=$plats'>Uppdatera</a>";
    
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


$sql2 = "SELECT foretagID, namn FROM foretag";
$result = mysqli_query($conn, $sql2);
$data2 = $result->fetch_all(MYSQLI_ASSOC);

echo "<form action='Lists.php' method='POST'>";
echo "<select name='Fnarvaro'>";
    foreach ($data2 as $row) {
        echo "<option value='".$row['namn']."'> ".$row['namn']." </option>";
    }
echo "</select>";
echo "<input type='submit' name='submit'/>";
echo "</form>";


if(isset($_POST['submit'])) {
    $foretagNamn = $_POST['Fnarvaro'];

    $sql = "SELECT foretag.namn, plats.elevID, dag.datum, narvaro.narvaro
    FROM narvaro
    INNER JOIN plats ON plats.platsID = narvaro.platsID
    INNER JOIN foretag ON foretag.foretagID = plats.foretagID
    INNER JOIN perioddag ON perioddag.perioddagID = narvaro.perioddagID
    INNER JOIN dag ON dag.dagID = perioddag.dagID
    WHERE foretag.namn = ? ORDER BY dag.datum ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $foretagNamn);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    //print_r($data);

    if (empty($data)) {
        echo "Ingen har praktiserat hos $foretagNamn";
    } else {
        echo "<table>";
        echo "<tr><th>Företag</th><th>Elev</th><th>Dag</th><th>Narvaro</th></tr>";
    
        foreach ($data as $row => $column) {

            if (is_null($column['narvaro'])) {
                $column['narvaro'] = "null";
            }
            
            $str = ['null', '1', '2', '3'];
            $rplc = ['icke anmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];

            $column2 = str_replace($str, $rplc, $column);
            
            echo "<tr><td>";
            echo $column['namn'];
            echo "</td><td>";
            echo $column['elevID'];
            echo "</td><td>";
            echo $column['datum'];
            echo "</td><td>";
            echo $column2['narvaro'];
        }
        echo "</table>";
    }
}
$sql2 = "SELECT periodNamn FROM period";
$result = mysqli_query($conn, $sql2);
$data2 = $result->fetch_all(MYSQLI_ASSOC);

echo "<form action='Lists.php' method='POST'>";
echo "<select name='Pnarvaro'>";
    foreach ($data2 as $row) {
        echo "<option value='".$row['periodNamn']."'> ".$row['periodNamn']." </option>";
    }
echo "</select>";
echo "<input type='submit' name='submt'/>";
echo "</form>";


if(isset($_POST['submt'])) {
    $periodNamn = $_POST['Pnarvaro'];

    $sql = "SELECT foretag.namn,elev.elevID,narvaro.narvaro,dag.datum FROM narvaro 
    INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
    INNER JOIN plats ON plats.platsID=narvaro.platsID
    INNER JOIN foretag ON foretag.foretagID=plats.foretagID
    INNER JOIN elev ON elev.elevID=plats.elevID
    INNER JOIN dag ON perioddag.dagID=dag.dagID
    INNER JOIN period ON plats.periodNamn=period.periodNamn 
    WHERE period.periodNamn=? ORDER BY dag.datum";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $periodNamn);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    //print_r($data);

    if (empty($data)) {
        echo "Ingen har praktiserat hos $periodNamn";
    } else {
        echo "<table>";
        echo "<tr><th>Företag</th><th>Elev</th><th>Dag</th><th>Narvaro</th><th>Ta bort narvaro</th></tr>";
    
        foreach ($data as $row => $column) {

            if (is_null($column['narvaro'])) {
                $column['narvaro'] = "null";
            }
            
            $str = ['null', '1', '2', '3'];
            $rplc = ['icke anmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];

            $column2 = str_replace($str, $rplc, $column);
            
            echo "<tr><td>";
            echo $column['namn'];
            echo "</td><td>";
            echo $column['elevID'];
            echo "</td><td>";
            echo $column['datum'];
            echo "</td><td>";
            echo $column2['narvaro'];
        }
        echo "</table>";
    }
}

$sql2 = "SELECT elevID FROM elev";
$result = mysqli_query($conn, $sql2);
$data2 = $result->fetch_all(MYSQLI_ASSOC);

echo "<form action='Lists.php' method='POST'>";
echo "<select name='Enarvaro'>";
    foreach ($data2 as $row) {
        echo "<option value='".$row['elevID']."'> ".$row['elevID']." </option>";
    }
echo "</select>";
echo "<input type='submit' name='sub'/>";
echo "</form>";


if(isset($_POST['sub'])) {
    $elevID = $_POST['Enarvaro'];

    $sql = "SELECT foretag.namn,elev.elevID,narvaro.narvaro,dag.datum FROM narvaro 
    INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
    INNER JOIN plats ON plats.platsID=narvaro.platsID
    INNER JOIN foretag ON foretag.foretagID=plats.foretagID
    INNER JOIN elev ON elev.elevID=plats.elevID
    INNER JOIN dag ON perioddag.dagID=dag.dagID 
    WHERE elev.elevID=? ORDER BY dag.datum";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $elevID);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    //print_r($data);

    if (empty($data)) {
        echo "Ingen har praktiserat hos $periodNamn";
    } else {
        echo "<table>";
        echo "<tr><th>Dag</th><th>Narvaro</th><th>Ta bort narvaro</th></tr>";
    
        foreach ($data as $row => $column) {

            if (is_null($column['narvaro'])) {
                $column['narvaro'] = "null";
            }
            
            $str = ['null', '1', '2', '3'];
            $rplc = ['icke anmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];

            $column2 = str_replace($str, $rplc, $column);
            
            echo "<tr><td>";
            echo $column['datum'];
            echo "</td><td>";
            echo $column2['narvaro'];
        }
        echo "</table>";
    }
} 


$sql3 = "SELECT klass FROM klass";
$result3 = mysqli_query($conn, $sql3);
$data3 = $result3->fetch_all(MYSQLI_ASSOC);

echo "<form action='Lists.php' method='POST'>";
echo "<select name='klass'>";
    foreach ($data3 as $row) {
        echo "<option value='".$row['klass']."'> ".$row['klass']." </option>";
    }
echo "</select>";
echo "<input type='submit' name='submitKlass'/>";
echo "</form>";

if(isset($_POST['submitKlass'])) {
    $klass = $_POST['klass'];

    $sql = "SELECT elev.elevID, plats.periodNamn, foretag.namn
    FROM elev
    LEFT JOIN plats ON plats.elevID = elev.elevID
    LEFT JOIN foretag ON plats.foretagID = foretag.foretagID
    WHERE elev.klass = ?
    ORDER BY elevID ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $klass);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    if(empty($data)) {
        echo "Ingen elev i $klass har fått en plats";
    } else {
        echo "<table>";
        echo "<tr><th>Elev</th><th>Period</th><th>Företag</th></tr>";

        foreach ($data as $row) {
            echo "<tr><td>";
            echo $row['elevID'];
            echo "</td><td>";
            echo $row['periodNamn'];
            echo "</td><td>";
            echo $row['namn'];
        }
        echo "</table>";
    }
}


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