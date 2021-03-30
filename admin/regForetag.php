<?php
    require_once '../connection.php';
    require_once '../RegisterFunctions.php';

    if(isset($_POST['namn'], $_POST['losenord'], $_POST['epost'], $_POST['telefon'])) {
        $namn = $_POST['namn'];
        $losenord = $_POST['losenord'];
        $epost = $_POST['epost'];
        $telefon = $_POST['telefon'];
     
        registerForetag($conn, $namn, $losenord, $epost, $telefon);
    }
?>