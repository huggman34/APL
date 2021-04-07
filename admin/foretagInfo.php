<?php
    require_once '../connection.php';

    $foretagID = $_POST['foretagID'];
    function foretagInfo($conn, $foretagID){

        $sql = "SELECT foretag.namn,elev.elevID,plats.periodNamn,narvaro.narvaro,dag.datum FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
        INNER JOIN plats ON plats.platsID=narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID=plats.foretagID
        INNER JOIN elev ON elev.elevID=plats.elevID
        INNER JOIN dag ON perioddag.dagID=dag.dagID
        WHERE dag.datum = CURRENT_DATE AND foretag.namn=?";
    
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
        echo "<thead><tr><th>Elev</th><th>Period</th><th>Närvaro idag</th></tr></thead><tbody>";

        foreach ($foretagInfo as $row => $column) {

            if (is_null($column['narvaro'])) {
                $column['narvaro'] = "null";
            }
            
            $str = ['null', '1', '2', '3'];
            $rplc = ['Oanmäld', 'Närvarande', 'Giltig frånvaro', 'Ogiltig frånvaro'];

            $column2 = str_replace($str, $rplc, $column);

            echo "<tr><td>";
            echo $column['elevID'];
            echo "</td><td>";
            echo $column['periodNamn'];
            echo "</td><td>";
            echo $column2['narvaro'];
            echo "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Ingen data är tillgänglig";
    }
?>