<?php
    require_once '../connection.php';
    require_once '../ViewFunctions.php';

    $handledarID = $_POST['handledarID'];

    function handledarInfo($conn, $handledarID){

        $sql = "SELECT handledare.fornamn,handledare.efternamn,elev.elevID,plats.periodNamn,narvaro.narvaro,dag.datum FROM narvaro 
        INNER JOIN perioddag ON perioddag.perioddagID=narvaro.perioddagID
        INNER JOIN plats ON plats.platsID=narvaro.platsID
        INNER JOIN foretag ON foretag.foretagID=plats.foretagID
        INNER JOIN elev ON elev.elevID=plats.elevID
        INNER JOIN dag ON perioddag.dagID=dag.dagID
        INNER JOIN handledare ON handledare.handledarID=plats.handledarID
        WHERE dag.datum = CURRENT_DATE AND handledare.fornamn=?";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $handledarID);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    $handledarInfo = handledarInfo($conn, $handledarID);

    if(!empty($handledarInfo)){
        echo "<table class='handledarInfo'>";
        echo "<thead><tr><th>Elev</th><th>Period</th><th>Närvaro idag</th></tr></thead><tbody>";

        foreach ($handledarInfo as $row => $column) {

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
        echo "Ingen elev arbetar med denna handledaren";
    }
?>