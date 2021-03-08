<?php
    require_once 'narvaroReportForm.php';
    include 'connection.php';

    $id = $_GET['id'];
    $sql = "DELETE FROM narvaro WHERE narvaroID = '$id'";

    if (mysqli_query($conn, $sql)){
        header('Location:narvaroReportForm.php');
        exit;
    } else{
        echo "Error deleting record";
    }
?>