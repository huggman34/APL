<?php
/**
 * Denna filen används för att kunna uppdatera select options som ska visa alla handledare även nya utan
 * att behöva uppdatera webbsidan med hjälp av AJAX request. filen hämtar alla handledare i handledar tabellen
 * i databasen genom allHandledare funktionen från ViewFunctions.php och gör om det till
 * JSON format som sedan lägger till datan som option tagar i relevanta select tagar
 */
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $foretag = allHandledare($conn);
    $data = json_encode($foretag);

    print_r($data);
?>