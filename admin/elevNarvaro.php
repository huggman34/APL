<?php
    require_once '../connection.php';

    $elevID = $_POST['elevID'];
    function elevNarvaro($conn, $elevID){

        $sql = "SELECT narvaroID, foretag.namn,elev.elevID,narvaro.narvaro,dag.datum FROM narvaro 
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
        echo "<thead><tr><th>Företag</th><th>Datum</th><th>Närvaro</th><th></th></tr></thead><tbody>";

        foreach ($elevNarvaro as $row => $column) {

            if (is_null($column['narvaro'])) {
                $column['narvaro'] = "null";
            }
            
            $str = ['null', '1', '2', '3'];
            $rplc = ['Oanmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];

            $column2 = str_replace($str, $rplc, $column);

            $narvaroID = $column['narvaroID'];
            $narvaro = $column2['narvaro'];
            
            echo "<tr><td>";
            echo $column['namn'];
            echo "</td><td>";
            echo $column['datum'];
            echo "</td><td>";
            echo $column2['narvaro'];
            echo "</td><td>";
            echo "<button type='button' onclick=\"updateElevNarvaro('$narvaroID', '$narvaro');\" >Update</button>";
            echo "</td></tr>";
        }
        echo "</tbody></table>";

    } else {
        echo "Ingen data är tillgänglig";
    }
?>