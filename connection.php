<?php 
/**
 * Denna filen tar servernamn, användarnamn, lösenord och vilken databas.
 * Sedan som gör den kopplingen via mysqli tilläget till vår lokala mysql databas.
 * Denna filen kommer att inkluderas i alla filer som behöver kommunicera med databasen.
 */
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'apl';

    $conn = new mysqli($servername, $username, $password, $db) or die("Unable to connect");
?>