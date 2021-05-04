<?php
/**
 * Denna filen används för att koppla en period med elever genom att 
 * ta emot AJAX request via ett formulär som skickar in period och elever.
 * Därefter använder den registerPlats funktionen från
 * RegisterFunctions.php för att sätta in datan i databasen.
 */
    require_once '../connection.php';
    require_once '../UpdateFunctions.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['elev'],$_POST['period'])) {
        $elevID = $_POST['elev'];
        $periodNamn = $_POST['period'];

        foreach ($elevID as $e) {
            registerPlats($conn,$e,$periodNamn);
        }
    }
?>