<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['elev'])) {
        $elevID = $_POST['elev'];
        $periodNamn = $_POST['period'];
        $handledare=$_POST['handledare'];
        

     foreach ($elevID as $e) {
        $exist=updatePlatsHand($conn,$handledare,$e);   
        }
        
    }
?>