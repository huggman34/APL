<?php
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['foretagID'], $_POST['namn'], $_POST['adress'])) {
        $foretagID = $_POST['foretagID'];
        $namn = $_POST['namn'];
        $adress = $_POST['adress'];
        
        updateForetag($conn, $namn, $adress, $foretagID);
    }
?>