<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['elev'],$_POST['period'])) {
        $elevID = $_POST['elev'];
        $periodNamn = $_POST['period'];

        foreach ($elevID as $e) {
            registerPlats($conn,$e,$periodNamn);
        }
    }
?>