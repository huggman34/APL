<?php
/**
 * Denna filen används för att kunna uppdatera select options som ska visa alla perioder även nya utan
 * att behöva uppdatera webbsidan med hjälp av AJAX request. filen hämtar alla perioder i period tabellen
 * i databasen genom allPeriod funktionen från ViewFunctions.php och gör om det till
 * JSON format som sedan lägger till datan som option taggar i relevanta select taggar
 */
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $allPeriod = allPeriod($conn);
    $data = json_encode($allPeriod);

    print_r($data);
?>