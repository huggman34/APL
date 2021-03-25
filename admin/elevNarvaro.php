<?php
    require_once '../connection.php';

    $elevID = $_POST['elevID'];
    function elevNarvaro($conn, $elevID){

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
        return $data;
    }

    $elevNarvaro = elevNarvaro($conn, $elevID);
    //print_r($elevNarvaro);

    if(!empty($elevNarvaro)){
        echo "<table class='elevNarvaro'>";
        echo "<thead><tr><th>Elev</th><th>Företag</th><th>Datum</th><th>Närvaro</th></tr></thead><tbody>";

        foreach ($elevNarvaro as $row) {
            echo "<tr><td>";
            echo $row['elevID'];
            echo "</td><td>";
            echo $row['namn'];
            echo "</td><td>";
            echo $row['datum'];
            echo "</td><td>";
            echo $row['narvaro'];
            echo "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Ingen data är tillgänglig";
    }
?>