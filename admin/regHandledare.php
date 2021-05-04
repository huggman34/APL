<?php
/**
 * Denna filen används för att registrera en handledare genom att 
 * ta emot AJAX request via ett formulär som skickar in förnamn, efternamn, E-post,
 * telefonnummer, lösenord och företagID.
 * Därefter använder den registerHandledare funktionen från
 * RegisterFunctions.php för att sätta in datan i databasen.
 */
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';
    
    if(!empty($_POST['fornamn']) && !empty($_POST['efternamn']) && !empty($_POST['epost']) && !empty($_POST['telefon']) && !empty($_POST['losenord']) && !empty($_POST['foretagID'])) {
        $foretagID = $_POST['foretagID'];
        $fornamn = $_POST['fornamn'];
        $efternamn = $_POST['efternamn'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];
        $losenord = $_POST['losenord'];

        registerHandledare($conn, $foretagID, $fornamn, $efternamn, $epost, $telefon, $losenord);
    }
?>