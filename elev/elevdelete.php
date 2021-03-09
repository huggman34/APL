<?php
/**
 * Denna filen används för att kunna radera elever i databasen
 * Den hämtar elevID sedan radera den eleven som är kopplad till den elevID
 */
    require_once 'elevlista.php';
    include_once '../connection.php';


    $id = $_GET['id'];
    $sql = "DELETE FROM elev WHERE elevID = '$id'";

    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:../perioddag/perioddaglista.php');
        exit;
    } else{
        echo "Error deleting record";
    }
?>