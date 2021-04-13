<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['elev'],$_POST['period'])) {
        $elevID = $_POST['elev'];
        $periodNamn = $_POST['period'];
        $handledare= $_POST['handledare'];
        $plats=$_POST['plats'];
        
        $exist=updatePlats($conn,$elevID,$periodNamn,$handledare,$plats);
        echo $plats,$elevID,$periodNamn,$handledare,$exist;
  
    }else{
        $elevID = $_POST['elev'];
        $handledare=$_POST['handledare'];

        foreach ($elevID as $e) {
            updatePlatsHand($conn,$handledare,$e); 

        }
    }
?>