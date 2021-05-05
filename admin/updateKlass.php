<?php
/**
 * Denna fil används för att uppdatera klasstabellen. 
 * När man klickar på en klass för att uppdatera den så skickar den med klassID för att man enkelt ska kunna välja vad man vill uppdatera.
 * Sedan skriver man in vad man vill att det ska uppdateras till.
 */
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['klass'], $_POST['nyKlass'])) {
        $klassID = $_POST['klass'];
        $nyKlass = $_POST['nyKlass'];
        
        updateKlass($conn, $nyKlass, $klassID);
    }
?>