<?php
    require_once '../connection.php';
    require_once '../ViewFunctions.php';

    $handledarID = $_POST['handledarID'];

    function handledarInfo($conn, $handledarID){

        $sql = "SELECT plats.elevID, plats.periodNamn
        FROM plats
        WHERE plats.handledarID = ?";
        
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
        echo "<thead><tr><th>Elev</th><th>Period</th></tr></thead><tbody>";

        foreach ($handledarInfo as $row => $column) {
            echo "<tr><td>";
            echo $column['elevID'];
            echo "</td><td>";
            echo $column['periodNamn'];
            echo "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "Ingen elev arbetar med denna handledaren";
    }
?>