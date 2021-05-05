<?php
/**
 * Denna fil används för att uppdatera elevtabellen. 
 * När man klickar på en elev för att uppdatera den så skickar den med elevID för att man enkelt ska kunna välja vad man vill uppdatera.
 * Sedan skriver man in vad man vill att det ska uppdateras till.
 */
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['elevID'], $_POST['fornamn'], $_POST['efternamn'], $_POST['klass'], $_POST['epost'], $_POST['telefon'])) {
        $elevID = $_POST['elevID'];
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $klass = $_POST['klass'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];

        updateElev($conn, $fornamn, $efternamn, $klass, $epost, $telefon, $elevID);
    }
?>