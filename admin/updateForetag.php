<?php
/**
 * Denna fil används för att uppdatera företagstabellen. 
 * När man klickar på en företag för att uppdatera den så skickar den med foretagID för att man enkelt ska kunna välja vad man vill uppdatera.
 * Sedan skriver man in vad man vill att det ska uppdateras till.
 */
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['foretagID'], $_POST['namn'], $_POST['adress'])) {
        $foretagID = $_POST['foretagID'];
        $namn = $_POST['namn'];
        $adress = $_POST['adress'];
        
        updateForetag($conn, $namn, $adress, $foretagID);
    }
?>