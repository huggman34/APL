<?php
    require_once 'elevlista.php';
    include_once '../connection.php';


    $id = $_GET['id'];
    $sql = "DELETE FROM elev WHERE elevID = '$id'";

    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:../perioddaglista.php');
        exit;
    } else{
        echo "Error deleting record";
    }


?>