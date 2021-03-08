<?php
    require_once 'reportForm.php';
    include 'connection.php';

    $id = $_GET['id'];
    $sql = "DELETE FROM narvaro WHERE narvaroID = '$id'";

    if (mysqli_query($conn, $sql)){
        header('Location:reportForm.php');
        exit;
    } else{
        echo "Error deleting record";
    }
?>