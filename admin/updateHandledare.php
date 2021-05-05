<?php
/**
 * Denna fil används för att uppdatera handledartabellen. 
 * När man klickar på en handledare för att uppdatera den så skickar den med handledarID för att man enkelt ska kunna välja vad man vill uppdatera.
 * Sedan skriver man in vad man vill att det ska uppdateras till.
 */
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';

    if(isset($_POST['handledarID'], $_POST['fornamn'], $_POST['efternamn'], $_POST['foretagID'], $_POST['epost'], $_POST['telefon'])) {
        $handledarID = $_POST['handledarID'];
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $foretagID = $_POST['foretagID'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];

        updateHandledare($conn, $fornamn, $efternamn, $foretagID, $epost, $telefon, $handledarID);
    }
?>