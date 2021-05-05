<?php
/**
 * Denna fil används för att uppdatera platstabellen. 
 * När man klickar på en plats för att uppdatera den så skickar den med platsID för att man enkelt ska kunna välja vad man vill uppdatera.
 * Sedan skriver man in vad man vill att det ska uppdateras till.
 */
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['platsID'], $_POST['handledarID'], $_POST['periodNamn'])) {
        $platsID = $_POST['platsID'];
        $handledarID = $_POST['handledarID'];
        $periodNamn = $_POST['periodNamn'];
        
        updatePlats($conn, $platsID, $handledarID, $periodNamn);
    }
?>