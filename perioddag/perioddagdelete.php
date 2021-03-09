<?php

/**
 * Denna fil tar emot det perioddagID som man skickar med ifrån 'perioodaglista.php' och tar bort tillhörande ID ifrån tabellen.
 */
    require_once 'perioddaglista.php';
    include_once '../connection.php';


    $id = $_GET['id'];
    $sql = "DELETE FROM perioddag WHERE perioddagID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:perioddaglista.php');
        exit;
    } else{
        echo "Error deleting record";
    }


?>