<?php
/**
 * Denna filen gör så att vi kan radera dagar från dag tabellen i databasen
 * Den radera dagen baserat på vilken dagID som skickas in.
 */
    require_once '../perioddag/perioddaglista.php';
    include_once '../connection.php';


    $id = $_GET['id'];
    $sql = "DELETE FROM dag WHERE dagID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:../perioddag/perioddaglista.php');
        exit;
    } else{
        echo "Error deleting record";
    }


?>