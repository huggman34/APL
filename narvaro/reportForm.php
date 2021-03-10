<?php
/**
 * Denna filen tar emot username från 'foretagLogin.php' och gör det till en session.
 * Sedan hämtar den alla elever som har praktik idag hos det företaget som är inloggat från databasen.
 * Om det inte finns något att hämta så har inga elever praktik idag hos företaget som är inloggat.
 * Om den finns elever som har praktik hos företaget idag, kan företaget lägga närvaro på eleverna.
 * Denna filen visar all data som finns i narvaro tabellen.
 */
    include "../connection.php";
    include_once '../registerFunctions.php';
    
    session_start();

    $username = $_SESSION["username"];
    echo "logged in as $username <br></br>";

    $sql = "SELECT elev.elevID, period.periodNamn, periodDagID, platsID
    FROM plats
    INNER JOIN elev ON elev.elevID = plats.elevID
    INNER JOIN foretag ON foretag.foretagsID = plats.foretagID
    INNER JOIN period ON period.periodNamn = plats.periodNamn
    INNER JOIN perioddag ON perioddag.periodNamn = plats.periodNamn
    INNER JOIN dag ON dag.dagID = perioddag.dagID
    WHERE foretag.namn = ? AND dag.datum = CURRENT_DATE";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    print_r($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>reportForm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }

        table, th, td {
         border: 1px solid black;
        }
    </style>
</head>
<body>
<br></br>
    <form action="reportForm.php" method="POST">
        <select name="elev">
            <?php
                if(!empty($data)) {
                    echo "<option disabled selected>".'-- Välj Elev --'."</option>";
                    foreach($data as $row) {
                            echo "<option value='" .$row['platsID'] .'|'. $row['periodDagID'].  "'> ".$row['elevID']." </option>";
                    }
                } else {
                    echo "<option disabled selected> Inga elever har praktik idag </option>";
                }
            ?>
        </select>
        <select name="narvaro">
                <option value="1">Närvarande</option>
                <option value="2">Giltig frånvaro</option>
                <option value="3">Ogiltig frånvaro</option>
        </select>
        <input class="submit" type="submit" name="submit" value="Insert"/>
    </form>
    <?php
        if(isset($_POST['submit'])) {
            registerNarvaro($conn, $_POST['elev'], $_POST['narvaro']);
        }
    ?>

    <?php

    $sqlget = "SELECT * FROM narvaro";
    $sqldata = mysqli_query($conn, $sqlget) or die("error");

    echo "<table style=3>";
    echo "<tr><th>narvaroID</th><th>platsID</th><th>periodDagID</th><th>narvaro</th><th>Ta bort narvaro</th></tr>";

    while($row = mysqli_fetch_assoc($sqldata)) {

        echo "<tr><td>";
        echo $row['narvaroID'];
        echo "</td><td>";
        echo $row['platsID'];
        echo "</td><td>";
        echo $row['perioddagID'];
        echo "</td><td>";
        echo $row['narvaro'];
        echo "</td><td>";
        ?>
        <a href="narvaroDelete.php?id=<?php echo $row['narvaroID'];?>">Delete</a>
        <?php
        echo "</td></tr>";
    }

    echo "</table>";
    
    $conn->close();
?>
</body>
</html>