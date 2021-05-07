<?php
/**
 * Denna filen används för att kunna uppdatera select options som ska visa alla klasser även nya utan
 * att behöva uppdatera webbsidan med hjälp av AJAX request. filen hämtar alla klasser i klass tabellen
 * i databasen genom Allklass funktionen från ViewFunctions.php och gör om det till
 * JSON format som sedan lägger till datan som option taggar i relevanta select taggar
 */
    require_once '../connection.php';
    require_once "../ViewFunctions.php";

    $klasser = Allklass($conn);
    $data = json_encode($klasser);

    print_r($data);
?>