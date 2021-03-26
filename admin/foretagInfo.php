<?php
    require_once '../connection.php';

    $foretagID = $_POST['foretagID'];
    function foretagInfo($conn, $foretagID){

        $sql = "SELECT foretag.namn,elev.elevID,plats.periodNamn FROM foretag 
        INNER JOIN plats ON plats.foretagID=foretag.foretagID
        INNER JOIN elev ON elev.elevID=plats.elevID
        WHERE foretag.foretagID=?";
    
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
        echo "<thead><tr><th>Företag</th><th>Elev</th><th>Period</th></tr></thead><tbody>";

        foreach ($foretagInfo as $row) {
            echo "<tr><td>";
            echo $row['foretagID'];
            echo "</td><td>";
            echo $row['elevID'];
            echo "</td><td>";
            echo $row['periodNamn'];
            echo "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Ingen data är tillgänglig";
    }
?>