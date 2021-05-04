<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['elev'], $_POST['handledare'])) {
        
        $elevID = $_POST['elev'];
        $handledare=$_POST['handledare'];

        foreach ($elevID as $e) {
            updatePlatsHand($conn,$handledare,$e);
        }
    }
?>