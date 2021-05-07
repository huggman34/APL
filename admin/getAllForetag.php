<?php
/**
 * Denna filen används för att kunna uppdatera select options som ska visa alla företag även nya utan
 * att behöva uppdatera webbsidan med hjälp av AJAX request. filen hämtar alla företag i företag tabellen
 * i databasen genom foretag funktionen från ViewFunctions.php och gör om det till
 * JSON format som sedan lägger till datan som option taggar i relevanta select taggar
 */
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $foretag = foretag($conn);
    $data = json_encode($foretag);

    print_r($data);
?>