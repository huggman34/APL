<?php
    include "connection.php";
    session_start();

    $username = $_SESSION["username"];
    echo "logged in as $username <br></br>";

    $sql = "SELECT fornamn, efternamn, period.namn, periodDagID, platsID
    FROM plats
    INNER JOIN elev ON elev.elevID = plats.platsID
    INNER JOIN foretag ON foretag.foretagsID = plats.foretagsID
    INNER JOIN period ON period.periodID = plats.periodID
    INNER JOIN perioddag ON perioddag.periodID = plats.periodID
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
    <title>narvaroReportForm</title>
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
    <form action="narvaroReport.php" method="POST">
        <select name="elev">
            <?php
                if(!empty($data)) {
                    echo "<option disabled selected>".'-- Välj Elev --'."</option>";
                    foreach($data as $row) {
                            echo "<option value='" .$row['platsID'] .'|'. $row['periodDagID'].  "'> ".$row['fornamn']." ".$row['efternamn']." </option>";
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
        echo $row['periodDagID'];
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