<?php
/**
 * Denna filen tar emot platsID, periodDagID och narvaro som skickas via 'reportForm.php'
 * Den kollar om datan som skickas in redan existerar i Narvaro tabellen.
 * Om datan inte redan finns i tabellen så lägger den in datan i tabellen.
 * Om datan redan finns då skriver den ut 'Eleven har redan registrerats närvaro'
 */
    include_once "../connection.php";

    $result = $_POST['elev'];

    $result_explode = explode('|', $result);
    
    $platsID = $result_explode[0];
    $periodDagID = $result_explode[1];
    $narvaro = $_POST['narvaro'];

    $dupeCheck = mysqli_query($conn ,"SELECT * FROM narvaro WHERE (platsID = '$platsID' AND periodDagID = '$periodDagID')");

    $result = $dupeCheck->num_rows;

    if($result == 0) {
        $stmt = $conn->prepare("INSERT INTO narvaro (platsID, periodDagID, narvaro) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $platsID, $periodDagID, $narvaro);

        if ($stmt->execute()) {
            echo "Närvaro har lagts till";
            header('Location:reportForm.php');
        } else {
            echo "Något gick fel";
        }
    } else {
        echo "Eleven har redan registrerats närvaro";
    }
?>