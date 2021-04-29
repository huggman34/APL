<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['platsID'], $_POST['handledarID'], $_POST['periodNamn'])) {
        $platsID = $_POST['platsID'];
        $handledarID = $_POST['handledarID'];
        $periodNamn = $_POST['periodNamn'];
        
        updatePlats($conn, $platsID, $handledarID, $periodNamn);
    }
?>