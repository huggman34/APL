<?php
/**
 * Denna filen används för att registrera ett företag genom att 
 * ta emot AJAX request via ett formulär som skickar in företagsnamnet och adressen.
 * Därefter använder den registerForetag funktionen från
 * RegisterFunctions.php för att sätta in datan i databasen.
 */
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(!empty($_POST['namn']) && !empty($_POST['adress'])) {
        $foretag = $_POST['namn'];
        $adress = $_POST['adress'];

        registerForetag($conn, $foretag, $adress);
    }
?>