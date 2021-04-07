<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['elev'], $_POST['period'], $_POST['foretag'])) {
        $elevID = $_POST['elev'];
        $periodNamn = $_POST['period'];
        $foretagID = $_POST['foretag'];
     
        updatePlats($conn, $periodNamn, $elevID, $foretagID);
    }
?>