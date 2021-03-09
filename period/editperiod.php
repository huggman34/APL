<?php 

    session_start();
    include_once 'connection.php';

    $periodNamn = $_POST['periodNamn'];
    $startdatum = '';
    $slutdatum = '';

    if(isset($_POST['periodNamn'])){
        $periodNamn = $_POST['periodNamn'];
        $startdatum = $_POST['startdatum'];
        $slutdatum = $_POST['slutdatum'];


        $sql = "UPDATE period SET startdatum='$startdatum', slutdatum='$slutdatum' WHERE periodNamn=$periodNamn";
        mysqli_query($conn, $sql);
            
    }
    header('location: perioddaglista.php');
?>