<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['plats'], $_POST['handledare'], $_POST['period'])) {
        $periodNamn = $_POST['period'];
        $handledare= $_POST['handledare'];
        $plats=$_POST['plats'];
        
        $exist=updatePlats($conn,$periodNamn,$handledare,$plats);
        echo $exist;

        header('Location: adminMain.php');
  
    }else{
        $elevID = $_POST['elev'];
        $handledare=$_POST['handledare'];

        foreach ($elevID as $e) {
            updatePlatsHand($conn,$handledare,$e); 

        }
        header('Location: adminMain.php');
    }
?>