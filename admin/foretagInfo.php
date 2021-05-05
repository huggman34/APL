<?php
/**
 * Denna filen används för att visa upp elever som praktiserar hos ett företag genom att ta emot företagsID
 * från ett AJAX request och visar alla elever och perioden de praktiserar/praktiserade hos företaget
 */
    require_once '../connection.php';
    require_once '../ViewFunctions.php';

    $foretagID = $_POST['foretagID'];
    
    function foretagInfo($conn, $foretagID){

        $sql = "SELECT plats.elevID, plats.periodNamn, foretag.namn
        FROM plats
        INNER JOIN foretag ON foretag.foretagID = plats.foretagID
        WHERE foretag.namn = ?";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $foretagID);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    $foretagInfo = foretagInfo($conn, $foretagID);

    if(!empty($foretagInfo)){
        echo "<table class='foretagInfo'>";
        echo "<thead><tr><th>Elev</th><th>Period</th></tr></thead><tbody>";

        foreach ($foretagInfo as $row => $column) {

            echo "<tr><td>";
            echo $column['elevID'];
            echo "</td><td>";
            echo $column['periodNamn'];
            echo "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Ingen elev arbetar på detta företag";
    }
?>