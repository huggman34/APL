<?php
/**
 * Denna fil används för att uppdatera elevnärvaro. 
 * När man klickar på en elev för att uppdatera den så skickar den med narvaroID för att man enkelt ska kunna välja vad man vill uppdatera.
 * Sedan skriver man in vad man vill att det ska uppdateras till.
 */
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['narvaroID'], $_POST['narvaro'])) {
        $narvaroID = $_POST['narvaroID'];
        $narvaro = $_POST['narvaro'];

        if($narvaro == 0) {
            $narvaro = null;
            updateElevNarvaro($conn, $narvaro, $narvaroID);
        } else {
            updateElevNarvaro($conn, $narvaro, $narvaroID);
        }
    }
?>