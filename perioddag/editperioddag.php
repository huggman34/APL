<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php 

/**
 * Denna fil används för att redigera perioddag tabellen. 
 * Genom att skicka in perioddagID kan man redigera perioden och dagen.
 */
    session_start();
    require_once '../connection.php';

    $periodDagID = $_POST['perioddagID'];
    $periodNamn = '';
    $dagID = '';

    if(isset($_POST['perioddagID'])){
        $perioddagID = $_POST['perioddagID'];
        $periodNamn = $_POST['periodNamn'];
        $dagID = $_POST['dagID'];


        $sql = "UPDATE perioddag SET periodNamn='$periodNamn', dagID='$dagID' WHERE periodDagID=$perioddagID";
        mysqli_query($conn, $sql);
            
    }
    header('location: ../Lists.php');
?>
</body>
</html>