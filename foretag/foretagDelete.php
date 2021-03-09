<?php
    require_once '../foretaglista.php';
    include_once '../connection.php';


    $id = $_GET['id'];
    $sql = "DELETE FROM foretag WHERE foretagsID = '$id'";
    if (mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location:../perioddag/perioddaglista.php');
        exit;
    } else{
        echo "Error deleting record";
    }


?>