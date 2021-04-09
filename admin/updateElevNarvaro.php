<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['narvaroID'], $_POST['narvaro'])) {
        $narvaroID = $_POST['narvaroID'];
        $narvaro = $_POST['narvaro'];

        if($narvaro == 0) {
            $narvaro = null;
            updateElevNarvaro($conn, $narvaro, $narvaroID);
        } else {
            updateElevNarvaro($conn, $narvaro, $narvaroID);
        }
    }
?>