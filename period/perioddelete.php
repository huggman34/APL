<?php

/**
 * Denna fil tar emot det periodID som man skickar med ifrån 'perioddaglista.php' och tar bort tillhörande ID ifrån tabellen.
 */

    require_once '../perioddag/perioddaglista.php';
    include_once '../connection.php';


    $id = $_GET['id'];
    $sql = "DELETE FROM period WHERE periodNamn = '$id'";
    echo $sql;
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:perioddaglista.php');
        exit;
    } else{
        echo "Error deleting record";
    }


?>